<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use DateTime;
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
     * @ORM\Column(type="integer")
     */
    private $totalTickets;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function getTotalTickets(): int
    {
        return $this->totalTickets;
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
        return $this->getDate()->add($this->movie->getDuration());
    }

    public function setMovie(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
}