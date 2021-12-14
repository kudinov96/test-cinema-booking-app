<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Collection\SessionCollection;
use App\Domain\Booking\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use DateInterval;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Booking\Entity\Session", mappedBy="movie")
     */
    public $sessions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $duration;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSessions(): array
    {
        return $this->sessions->getArrayCopy();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDuration(): DateInterval
    {
        return new DateInterval($this->duration);
    }
}