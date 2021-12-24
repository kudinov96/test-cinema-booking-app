<?php

namespace App\Tests\Unit\Domain\Booking\Entity;

use App\Domain\Booking\Collection\SessionCollection;
use App\Domain\Booking\Entity\Movie;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    private Movie $movie;

    public function setUp(): void
    {
        $this->movie = new Movie('Movie 1', 'PT1H30M');
    }

    public function testGetName(): void
    {
        $this->assertSame('Movie 1', $this->movie->getName());
    }

    public function testGetDuration(): void
    {
        $this->assertEquals(new \DateInterval('PT1H30M'), $this->movie->getDuration());
    }

    public function testGetSessions(): void
    {
        $this->assertEquals(new SessionCollection(), $this->movie->getSessions());
    }
}
