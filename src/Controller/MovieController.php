<?php

namespace App\Controller;

use App\Domain\Booking\Command\BookingCommand;
use App\Domain\Booking\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/', name: 'movies')]
    public function index(): Response
    {
        $movies = $this->repository->findAll();

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/movie/{uuid}', name: 'single_movie')]
    public function singleMovie(string $uuid): Response
    {
        $movie = $this->repository->find($uuid);

        return $this->render('movie/single.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/booking', name: 'booking', methods: 'POST')]
    public function actionBooking(MessageBusInterface $bus, Request $request): Response
    {
        $data = $request->request->all();
        $bus->dispatch(new BookingCommand($data['name'], $data['phone_number'], $data['session_id']));

        return $this->redirectToRoute('movies');
    }
}
