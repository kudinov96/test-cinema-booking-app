<?php

namespace App\Tests\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    public function setUp(): void
    {
        $this->movie = new Movie('Movie 1', 'PT1H30M');
        $this->session = new Session($this->movie, 100, new \DateTime('2021-01-22 18:00'));
        $this->client = new ClientDetails('Ivan Bogdanov', 79001112233);
        $this->ticket = new Ticket($this->session, $this->client);
    }

    public function testGetSession(): void
    {
        $this->assertEquals($this->session, $this->ticket->getSession());
    }

    public function testGetClient(): void
    {
        $this->assertEquals($this->client, $this->ticket->getClient());
    }
}