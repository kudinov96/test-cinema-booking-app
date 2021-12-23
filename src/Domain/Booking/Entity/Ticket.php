<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Session;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=App\Domain\Booking\Repository\TicketRepository::class)
 */
class Ticket
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\Embedded(class="App\Domain\Booking\Entity\ValueObject\ClientDetails")
     */
    private $client;

    public function __construct(Session $session, ClientDetails $client)
    {
        $this->id = Uuid::uuid4();
        $this->session = $session;
        $this->client = $client;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function getClient(): ClientDetails
    {
        return $this->client;
    }
}