<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Entity\ValueObject\ClientDetails;

class Booking
{
    public function __construct(
        private ClientDetails $client,
        private string $session_id,
    ) { }

    public function getClient(): ClientDetails
    {
        return $this->client;
    }

    public function getSessionId(): string
    {
        return $this->session_id;
    }
}