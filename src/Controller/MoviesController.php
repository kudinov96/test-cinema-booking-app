<?php

namespace App\Controller;

use App\Domain\Booking\Entity\Movie;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function index(ManagerRegistry $doctrine): Response
    {
        /*$entityManager = $doctrine->getManager();

        $movie = new Movie();
        $movie->uuid = Uuid::uuid4();
        $movie->name = 'Test';
        $movie->duration = '123';
        $entityManager->persist($movie);
        $entityManager->flush();*/
        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MoviesController.php',
        ]);*/

        return new Response('Movies');
    }
}
