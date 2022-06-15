<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage()
    {
        return $this->render('homepage.html.twig', [
            'title' => 'Accueil'
        ]);
    }

    #[Route('/player/{slug}', name: 'app_player')]
    public function playerResult()
    {
        return $this->render('results.html.twig');
    }
}