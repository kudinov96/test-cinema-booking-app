<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Collection\TicketCollection;
use App\Domain\Booking\Repository\SessionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
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
     * @ORM\ManyToOne(targetEntity="App\Domain\Booking\Entity\Movie", inversedBy="sessions")
     */
    private $movie;

    /**
     * @ORM\OneToMany (targetEntity="App\Domain\Booking\Entity\Ticket", mappedBy="session")
     */
    private $tickets;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalTickets;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function __construct(Movie $movie, int $totalTickets, DateTime $date)
    {
        $this->id = Uuid::uuid4();
        $this->movie = $movie;
        $this->totalTickets = $totalTickets;
        $this->date = $date;
        $this->tickets = new TicketCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function getTotalTickets(): int
    {
        return $this->totalTickets;
    }

    public function getAmountRemainingTickets(): int
    {
        return $this->totalTickets - $this->tickets->count();
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getSessionStart(): DateTime
    {
        return $this->getDate();
    }

    public function getSessionEnd(): DateTime
    {
        return $this->date->add($this->movie->getDuration());
    }
}