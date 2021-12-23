<?php

namespace App\Tests\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TicketRepositoryTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->entityManager = $container->get(ManagerRegistry::class)->getManager();
        $this->ticketRepository = $this->entityManager->getRepository(Ticket::class);

        $movieRepository = $this->entityManager->getRepository(Movie::class);
        $sessionRepository = $this->entityManager->getRepository(Session::class);

        $movie = $movieRepository->findOneBy(['name' => 'Movie 1']);
        $session = $sessionRepository->findOneBy(['movie' => $movie->getId()->toString()]);
        $client = new ClientDetails('Ivan Bogdanov', 79001112233);

        $this->ticket = new Ticket($session, $client);
    }

    public function testSave(): void
    {
        $this->ticketRepository->save($this->ticket);
        $saved_ticket = $this->ticketRepository->find($this->ticket->getId()->toString());

        $this->assertEquals($this->ticket, $saved_ticket);
    }
}