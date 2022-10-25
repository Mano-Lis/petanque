<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;
use App\Form\GameFormType;
use App\Form\TeamFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GameController extends AbstractController
{
    #[Route('/gameform', name: 'app_game_form')]
    public function gameForm(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $game = new Game();

        /*
        $player1 = new Player();
        $player1->name = 'manu';

        $team1 = new Team();
        $team1->addPlayer($player1);
        
        $player2 = new Player();
        $player2->name = 'kiki';

        $team2 = new Team();
        $team2->addPlayer($player2);

        $game = new Game();
        $game->addTeam($team1);
        $game->addTeam($team2);
        */
        
        $form = $this->createForm(GameFormType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();
            
            // $errors = $validator->validate($game);

            // if (count($errors) > 0) {
            //     $errorsString = (string) $errors;
            //     return new Response($errorsString);
            // }

            $em->persist($game);
            $em->flush();
        }
    
        return $this->renderForm('gameform.html.twig', [
            'form' => $form
        ]);
    }
}

