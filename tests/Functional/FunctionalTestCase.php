<?php

namespace App\Tests\Functional;

use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FunctionalTestCase extends KernelTestCase
{
    protected ContainerInterface $container;
    protected EntityManager $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
        $this->entityManager = $this->container->get(ManagerRegistry::class)->getManager();
    }
}