<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'firstname' => "Gandalf"
        ]);
    }

    #[Route('/cesar', name: 'app_cesar')]
    public function cesar(): Response
    {
        $username = "Gérard";
        $numberOfLegions = "<script>alert(\"Alerte\")</script>";

        return $this->render('main/cesar.html.twig', [
            "username" => $username,
            "numberOfLegions" => $numberOfLegions
        ]);
    }
}
