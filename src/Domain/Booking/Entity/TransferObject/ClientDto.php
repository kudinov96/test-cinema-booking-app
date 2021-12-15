<?php

namespace App\Domain\Booking\Entity\TransferObject;

class ClientDto
{
    public function __construct(
        public string $name,
        public int $phoneNumber,
    ) { }
}