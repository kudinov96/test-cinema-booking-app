<?php

namespace App\Controller;

use App\Domain\Booking\Collection\SessionCollection;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Repository\MovieRepository;
use App\Domain\Booking\Repository\SessionRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function index(ManagerRegistry $doctrine, MovieRepository $movieRepository, SessionRepository $sessionRepository): Response
    {
        $entityManager = $doctrine->getManager();

        /*$movie = new Movie();
        $movie->id = Uuid::uuid4();
        $movie->name = 'Movie 2';
        $movie->duration = 'PT1H30M';*/

        /*$movie = (new MovieRepository($doctrine))->find('0eb61010-74e6-44f5-8c03-7510efd69fe2');

        $session1 = new Session();
        $session1->id = Uuid::uuid4();
        $session1->setMovie($movie);
        $session1->totalTickets = 90;
        $session1->date = new DateTime('2021-01-22 18:30');

        $entityManager->persist($session1);
        $entityManager->persist($movie);
        $entityManager->flush()*/;

       /* $session = new Session();
        $session->id = Uuid::uuid4();
        $session->totalTickets = 120;
        $session->date = new DateTime('2021-01-22 18:30');

        $entityManager->persist($session);
        $entityManager->flush();*/

        $movies = $movieRepository->findAll();

        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
