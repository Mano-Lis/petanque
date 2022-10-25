<?php

namespace Tests\Validator;

use App\Entity\Player;
use App\Entity\Team;
use App\Validator\NoDuplicatePlayerInGame;
use App\Validator\NoDuplicatePlayerInGameValidator;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class NoDuplicatePlayerInGameValidatorTest extends ConstraintValidatorTestCase
{
    public function createValidator()
    {
        return new NoDuplicatePlayerInGameValidator();
    }

    public function testIfAPlayerAppearsInMoreThanOneTeam()
    {
        $constraint = new NoDuplicatePlayerInGame();

        $team1 = new Team();

        $player1 = new Player();
        $player1->id = 1;

        $player2 = new Player();
        $player2->id = 2;

        $player3 = new Player();
        $player3->id = 3;

        $team1->addPlayer($player1);
        $team1->addPlayer($player2);
        $team1->addPlayer($player3); 

        $team2 = new Team();

        $player4 = new Player();
        $player4->id = 4;

        $player5 = new Player();
        $player5->id = 5;

        $team2->addPlayer($player4);
        $team2->addPlayer($player5);
        $team2->addPlayer($player1);

        $this->validator->validate(new ArrayCollection([
            $team1,
            $team2
        ]), $constraint);

        $this
            ->buildViolation($constraint->message)
            ->atPath('property.path[0].players[1]')
            ->buildNextViolation($constraint->message)
            ->atPath('property.path[1].players[1]')
            ->assertRaised();        
    }

    public function testIfThereIsNoDuplicatePlayer()
    {
        $constraint = new NoDuplicatePlayerInGame();

        $team1 = new Team();

        $player1 = new Player();
        $player1->id = 1;

        $player2 = new Player();
        $player2->id = 2;

        $player3 = new Player();
        $player3->id = 3;

        $team1->addPlayer($player1);
        $team1->addPlayer($player2);
        $team1->addPlayer($player3); 

        $team2 = new Team();

        $player4 = new Player();
        $player4->id = 4;

        $player5 = new Player();
        $player5->id = 5;

        $player6 = new Player();
        $player6->id = 6;

        $team2->addPlayer($player4);
        $team2->addPlayer($player5);
        $team2->addPlayer($player6);

        $this->validator->validate(new ArrayCollection([
            $team1,
            $team2
        ]), $constraint);

        $this->assertNoViolation();
    }
}