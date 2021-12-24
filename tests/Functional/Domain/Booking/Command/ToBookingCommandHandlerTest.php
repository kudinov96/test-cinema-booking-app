<?php

namespace App\Tests\Functional\Domain\Booking\Command;

use App\Domain\Booking\Command\ToBookingCommand;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Tests\Functional\FunctionalTestCase;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class ToBookingCommandHandlerTest extends FunctionalTestCase
{
    private $bus;
    private ObjectRepository $movieRepository;
    private ObjectRepository $sessionRepository;
    private ObjectRepository $ticketRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->bus = $this->container->get(MessageBusInterface::class);
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
        $this->sessionRepository = $this->entityManager->getRepository(Session::class);
        $this->ticketRepository = $this->entityManager->getRepository(Ticket::class);
    }

    public function testBookingCommandHandler(): void
    {
        $movie = $this->movieRepository->findOneBy(['name' => 'Movie 2']);
        $session = $this->sessionRepository->findOneBy(['movie' => $movie->getId()->toString()]);
        $toBookingCommand = new ToBookingCommand('Test', 79991234455, $session->getId()->toString());

        $this->bus->dispatch($toBookingCommand);
        $saved_ticket = $this->ticketRepository->findOneBy(['session' => $session->getId()->toString()]);

        $this->assertSame($session->getId()->toString(), $saved_ticket->getSession()->getId()->toString());
    }

    public function testBookingCommandHandlerIfTickedExpired(): void
    {
        $session = $this->sessionRepository->findOneBy(['total_tickets' => 5]);
        $toBookingCommand = new ToBookingCommand('Test', 79991234455, $session->getId()->toString());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Tickets expired');
        $this->bus->dispatch($toBookingCommand);
    }
}