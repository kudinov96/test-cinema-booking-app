<?php

namespace App\Controller;

use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Repository\MovieRepository;
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
        /*$entityManager = $doctrine->getManager();

        $movie = new Movie();
        $movie->uuid = Uuid::uuid4();
        $movie->name = 'Movie 2';
        $movie->duration = 'PT1H30M';
        $entityManager->persist($movie);
        $entityManager->flush();*/
        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MovieController.php',
        ]);
        */

        $movies = (new MovieRepository($doctrine))->findAll();

        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
