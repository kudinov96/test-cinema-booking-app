<?php

namespace App\Controller;

use App\Domain\Booking\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    private SessionRepository $repository;

    public function __construct(SessionRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/movie/{movie_uuid}/session/{session_uuid}', name: 'single_session')]
    public function singleSession(string $session_uuid): Response
    {
        $session = $this->repository->find($session_uuid);

        return $this->render('session/single.html.twig', [
            'session' => $session,
        ]);
    }
}