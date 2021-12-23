<?php

namespace App\Tests\Domain\Booking\Entity;

use App\Domain\Booking\Collection\TicketCollection;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public function setUp(): void
    {
        $this->movie = new Movie('Movie 1', 'PT1H30M');
        $this->session = new Session($this->movie, 100, new \DateTime('2021-01-22 18:00'));
    }

    public function testGetMovie(): void
    {
        $this->assertEquals($this->movie, $this->session->getMovie());
    }

    public function testGetTickets(): void
    {
        $this->assertEquals(new TicketCollection(), $this->session->getTickets());
    }

    public function testGetTotalTickets(): void
    {
        $this->assertSame(100, $this->session->getTotalTickets());
    }

    public function getAmountRemainingTickets(): void
    {
        $this->assertSame(100, $this->session->getTotalTickets() - $this->session->getTickets()->count());
    }

    public function testGetDate(): void
    {
        $this->assertEquals(new \DateTime('2021-01-22 18:00'), $this->session->getDate());
    }

    public function getSessionEnd(): void
    {
        $this->assertEquals(new \DateTime('2021-01-22 17:30'), $this->session->getSessionEnd());
    }
}