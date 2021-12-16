<?php

namespace App\Domain\Booking\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class ClientDetails
{
    /** @ORM\Column(type = "string") */
    private $name;

    /** @ORM\Column(type = "integer") */
    private $phone_number;

    public function __construct(string $name, int $phone_number) {
        $this->name = $name;
        $this->phone_number = $phone_number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): int
    {
        return $this->phone_number;
    }
}