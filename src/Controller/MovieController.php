<?php

namespace App\Controller;

use App\Domain\Booking\Command\ToBookingCommand;
use App\Domain\Booking\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MovieController extends AbstractController
{
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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
        $toBookingCommand = new ToBookingCommand($data['name'], $data['phone_number'], $data['session_id']);
        $errors = $this->validator->validate($toBookingCommand);

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->addFlash(
                    'validate',
                    $error->getPropertyPath() . ': ' . $error->getMessage()
                );
            }
        } else {
            $bus->dispatch($toBookingCommand);
        }

        return $this->redirectToRoute('movies');
    }
}
