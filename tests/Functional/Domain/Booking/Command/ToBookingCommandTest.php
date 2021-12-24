<?php

namespace App\Tests\Functional\Domain\Booking\Command;

use App\Domain\Booking\Command\ToBookingCommand;
use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ToBookingCommandTest extends FunctionalTestCase
{
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->container->get(ValidatorInterface::class);
    }

    public function testValidateSuccess(): void
    {
        $toBookingCommand = new ToBookingCommand('Name 1', 79991234455, '5ef056e3-0202-4475-9a79-192eb3713686');
        $errors = $this->validator->validate($toBookingCommand);

        $this->assertEmpty($errors);
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
}