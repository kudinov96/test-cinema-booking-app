<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use App\Domain\Booking\Repository\SessionRepository;
use App\Domain\Booking\Repository\TicketRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ToBookingCommandHandler implements MessageHandlerInterface
{
    private SessionRepository $sessionRepository;
    private TicketRepository $ticketRepository;

    public function __construct(SessionRepository $sessionRepository, TicketRepository $ticketRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function __invoke(ToBookingCommand $toBookingCommand)
    {
        $session = $this->sessionRepository->find($toBookingCommand->getSessionId());
        if ($session->getAmountRemainingTickets() <= 0) throw new \Exception('Tickets expired');

        $client = new ClientDetails($toBookingCommand->getName(), $toBookingCommand->getPhoneNumber());
        $ticket = new Ticket($session, $client);
        $this->ticketRepository->save($ticket);
    }
}