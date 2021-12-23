<?php

namespace App\Tests\Domain\Booking\Command;

use App\Domain\Booking\Command\ToBookingCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ToBookingCommandTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->validator = $container->get(ValidatorInterface::class);
        $this->toBookingCommand = new ToBookingCommand('Name 1', 79991234455, '5ef056e3-0202-4475-9a79-192eb3713686');
    }

    public function testValidateName(): void
    {
        $toBookingCommand = new ToBookingCommand('', 79991234455, '5ef056e3-0202-4475-9a79-192eb3713686');
        $errors = $this->validator->validate($toBookingCommand);

        $this->assertSame('This value should not be blank.', $errors[0]->getMessage());
    }

    public function testValidatePhoneNumber(): void
    {
        $toBookingCommand = new ToBookingCommand('Name 1', '', '5ef056e3-0202-4475-9a79-192eb3713686');
        $errors = $this->validator->validate($toBookingCommand);

        $this->assertSame('This value should not be blank.', $errors[0]->getMessage());
    }

    public function testValidateSessionId(): void
    {
        $toBookingCommand = new ToBookingCommand('Name 1', 79991234455, 'test');
        $errors = $this->validator->validate($toBookingCommand);

        $this->assertSame('This is not a valid UUID.', $errors[0]->getMessage());
    }

    public function testGetName(): void
    {
        $this->assertSame('Name 1', $this->toBookingCommand->getName());
    }

    public function getPhoneNumber(): void
    {
        $this->assertSame(79991234455, $this->toBookingCommand->getPhoneNumber());
    }

    public function getSessionId(): void
    {
        $this->assertSame('5ef056e3-0202-4475-9a79-192eb3713686', $this->toBookingCommand->getSessionId());
    }
}