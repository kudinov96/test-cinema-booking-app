<?php

namespace App\Controller;

use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\TransferObject\ClientDto;
use App\Domain\Booking\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function index(ManagerRegistry $doctrine, MovieRepository $movieRepository): Response
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
}
