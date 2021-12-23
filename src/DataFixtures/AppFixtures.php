<?php

namespace App\DataFixtures;

use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\ClientDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create Movies
        for ($i = 1; $i <= 2; $i++) {
            $movie = new Movie('Movie ' . $i, 'PT1H30M');

            // Create Sessions
            for ($j = 1; $j <= 2; $j++) {
                $total_tickets = 100;
                if ($i === 1 && $j === 1) {
                    $total_tickets = 5;
                }
                $session = new Session($movie, $total_tickets, new \DateTime('2021-01-22 18:00'));
                $manager->persist($session);

                // Create Tickets
                for ($k = 1; $k <= 5; $k++) {
                    $ticket = new Ticket($session, new ClientDetails('Ivan' . $k, 79991234567));
                    $manager->persist($ticket);
                }
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
