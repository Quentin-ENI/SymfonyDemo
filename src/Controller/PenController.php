<?php

namespace App\Controller;

use App\Entity\Pen;
use App\Repository\AnimalRepository;
use App\Repository\PenRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pen', name: 'pen_')]
class PenController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $pen = new Pen();
        $pen->setName("Chicago");
        $pen->setNumber(2222);
        $pen->setSurface(5000.00);
        $entityManager->persist($pen);
        $entityManager->flush();

        return $this->render('pen/create.html.twig', [
            'controller_name' => 'PenController',
        ]);
    }

    #[Route('/', name: 'list')]
    public function index(PenRepository $penRepository): Response
    {
        $pens = $penRepository->findAll();
        dump($pens);
        return $this->render('pen/index.html.twig', [
            'pens' => $pens
        ]);
    }
}
