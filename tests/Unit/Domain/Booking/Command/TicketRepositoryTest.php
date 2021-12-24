<?php

namespace App\Tests\Unit\Domain\Booking\Command;

use App\Domain\Booking\Command\ToBookingCommand;
use PHPUnit\Framework\TestCase;

class TicketRepositoryTest extends TestCase
{
    private ToBookingCommand $toBookingCommand;

    public function setUp(): void
    {
        $this->toBookingCommand = new ToBookingCommand('Name 1', 79991234455, '5ef056e3-0202-4475-9a79-192eb3713686');
    }

    public function testGetName(): void
    {
        $this->assertSame('Name 1', $this->toBookingCommand->getName());
    }

    public function testGetPhoneNumber(): void
    {
        $this->assertSame('79991234455', $this->toBookingCommand->getPhoneNumber());
    }

    public function testGetSessionId(): void
    {
        $this->assertSame('5ef056e3-0202-4475-9a79-192eb3713686', $this->toBookingCommand->getSessionId());
    }
}