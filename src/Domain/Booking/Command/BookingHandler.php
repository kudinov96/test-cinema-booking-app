<?php

namespace App\Domain\Booking\Command;
use App\Domain\Booking\Repository\SessionRepository;
use App\Domain\Booking\Repository\TicketRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class BookingHandler implements MessageHandlerInterface
{
    private SessionRepository $sessionRepository;
    private TicketRepository $ticketRepository;

    public function __construct(SessionRepository $sessionRepository, TicketRepository $ticketRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function __invoke(Booking $booking)
    {
        $session = $this->sessionRepository->find($booking->getSessionId());
        $client = $booking->getClient();

        if ($session->getAmountRemainingTickets() <= 0) throw new \Exception('Tickets expired');

        $this->ticketRepository->save($session, $client);
    }
}