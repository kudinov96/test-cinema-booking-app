<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use Ramsey\Uuid\UuidInterface;

class Booking
{
    public function __construct(
        private ClientDetails $client,
        private string $sessionId,
    ) { }

    public function getClient(): ClientDetails
    {
        return $this->client;
    }

    public function getSessionId(): string
    {
        return $this->sessionId;
    }
}