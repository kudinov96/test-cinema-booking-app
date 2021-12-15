<?php

namespace App\Domain\Booking\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Booking\Entity\TransferObject\ClientDto;

/**
 * @ORM\Embeddable
 */
class ClientDetails
{
    /** @ORM\Column(type = "string") */
    private $name;

    /** @ORM\Column(type = "integer") */
    private $phoneNumber;

    public function __construct(ClientDto $clientDto) {
        $this->name = $clientDto->name;
        $this->phoneNumber = $clientDto->phoneNumber;
    }
}