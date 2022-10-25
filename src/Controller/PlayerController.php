<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(PlayerRepository $playerRepository)
    {
        // dd($playerRepository->rankPlayers());
        return $this->render('homepage.html.twig', [
            'title' => 'Accueil'
        ]);
    }

    #[Route('/player/{slug}', name: 'app_player')]
    public function playerResult()
    {
        return $this->render('cardboard.html.twig');
    }
}