<?php

namespace App\Domain\Booking\Command;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use App\Domain\Booking\Repository\SessionRepository;
use App\Domain\Booking\Repository\TicketRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookingCommandHandler implements MessageHandlerInterface
{
    private SessionRepository $sessionRepository;
    private TicketRepository $ticketRepository;
    private ValidatorInterface $validator;

    public function __construct(SessionRepository $sessionRepository, TicketRepository $ticketRepository, ValidatorInterface $validator)
    {
        $this->sessionRepository = $sessionRepository;
        $this->ticketRepository = $ticketRepository;
        $this->validator = $validator;
    }

    public function __invoke(BookingCommand $booking)
    {
        $this->validation($booking);

        $session = $this->sessionRepository->find($booking->getSessionId());
        if ($session->getAmountRemainingTickets() <= 0) throw new \Exception('Tickets expired');

        $client = new ClientDetails($booking->getName(), $booking->getPhoneNumber());
        $ticket = new Ticket($session, $client);
        $this->ticketRepository->save($ticket);
    }

    public function validation(BookingCommand $booking): void
    {
        $errors = $this->validator->validate($booking);
        if (count($errors) > 0) dd($errors);
    }
}