<?php

namespace App\Controller;

use App\Domain\Booking\Command\Booking;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use App\Domain\Booking\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function index(MovieRepository $movieRepository): Response
    {
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
        $client = new ClientDetails($data['name'], $data['phone_number']);

        $bus->dispatch(new Booking($client, $data['session_id']));

        return $this->redirectToRoute('movies');
    }
}
