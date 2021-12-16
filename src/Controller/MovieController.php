<?php

namespace App\Controller;

use App\Domain\Booking\Command\Booking;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use App\Domain\Booking\Repository\MovieRepository;
use App\Domain\Booking\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function index(/*ManagerRegistry $doctrine, */MovieRepository $movieRepository): Response
    {
        /*
        $entityManager = $doctrine->getManager();
        $movie = new Movie('Film 1', 'PT1H30M');

        $session1 = new Session($movie, 100, new \DateTime('2021-01-22 18:30'));
        $session2 = new Session($movie, 60, new \DateTime('2021-01-22 21:00'));

        $ticket1 = new Ticket($session1, new ClientDto('Ivan', 11111111));
        $ticket2 = new Ticket($session1, new ClientDto('Anton', 22222222));
        $ticket3 = new Ticket($session2, new ClientDto('Oleg', 3333333));

        $entityManager->persist($movie);
        $entityManager->persist($session1);
        $entityManager->persist($session2);
        $entityManager->persist($ticket1);
        $entityManager->persist($ticket2);
        $entityManager->persist($ticket3);
        $entityManager->flush();*/

        $movies = $movieRepository->findAll();

        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }

    /**
     * @Route("/booking", name="booking", methods={"POST"})
     */
    public function actionBooking(MessageBusInterface $bus, Request $request): Response
    {
        $data = $request->request->all();
        $client = new ClientDetails($data['name'], $data['phoneNumber']);
        $sessionId = $data['sessionId'];

        $bus->dispatch(new Booking($client, $sessionId));

        return $this->redirectToRoute('movies');
    }
}
