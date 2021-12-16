<?php

namespace App\Domain\Booking\Command;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class BookingHandler implements MessageHandlerInterface
{
    public function __invoke(Booking $booking)
    {

    }
}