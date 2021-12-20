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

    /** @ORM\Column(type = "string") */
    private $phone_number;

    public function __construct(string $name, string $phone_number) {
        $this->name = $name;
        $this->phone_number = $phone_number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }
}