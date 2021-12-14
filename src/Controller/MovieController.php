<?php

namespace App\Controller;

use App\Domain\Booking\Collection\SessionCollection;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Repository\MovieRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        /*$movie = new Movie();
        $movie->id = Uuid::uuid4();
        $movie->name = 'Movie 1';
        $movie->duration = 'PT1H30M';

        $session1 = new Session();
        $session1->id = Uuid::uuid4();
        $session1->setMovie($movie);
        $session1->totalTickets = 100;
        $session1->date = new DateTime('2021-01-22 22:00');

        $entityManager->persist($session1);
        $entityManager->persist($movie);
        $entityManager->flush();*/

        $movies = (new MovieRepository($doctrine))->findAll();

        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
