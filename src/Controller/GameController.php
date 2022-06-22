<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;
use App\Form\GameFormType;
use App\Form\TeamFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/gameform', name: 'app_game_form')]
    public function gameForm(Request $request): Response
    {

        $team = new Team();
        
        $player1 = new Player();
        $player1->name = 'John';
        $team->addPlayer($player1);
        
        $player2 = new Player();
        $player2->name = 'Jane';
        $team->addPlayer($player2);


        $player3 = new Player();
        $player3->name = 'Jack';
        $team->addPlayer($player3);

        
        $player4 = new Player();
        $player4->name = 'Janis';
        $team->addPlayer($player4);


        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $e = $form->getData();
            dd($e);
        }
    
        return $this->renderForm('result.html.twig', [
            'form' => $form
        ]);
    }
}

