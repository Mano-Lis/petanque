<?php

namespace Tests\Validator;

use App\Entity\Game;
use App\Entity\Team;
use App\Validator\CorrectVictoryScore;
use App\Validator\CorrectVictoryScoreValidator;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class CorrectVictoryScoreValidatorTest extends ConstraintValidatorTestCase
{
    public function createValidator()
    {
       return new CorrectVictoryScoreValidator();
    }


    public function testIfTwoTeamsHaveScoreOver13()
    {
        $constraint = new CorrectVictoryScore();

        $team1 = new Team();
        $team1->score = 14;
        $team2 = new Team();
        $team2->score = 16;
        
        $this->validator->validate(new ArrayCollection([
            $team1,
            $team2
        ]), $constraint);

        $this
            ->buildViolation($constraint->message2)
            ->atPath('property.path[0].score')
            ->buildNextViolation($constraint->message2)
            ->atPath('property.path[1].score')
            ->assertRaised();
    }

    public function testIfTwoTeamsHaveScoreUnder13()
    {
        $constraint = new CorrectVictoryScore();

        $team1 = new Team();
        $team1->score = 8;
        $team2 = new Team();
        $team2->score = 5;
        
        $this->validator->validate(new ArrayCollection([
            $team1,
            $team2
        ]), $constraint);

        $this
            ->buildViolation($constraint->message1)
            ->assertRaised();
    }

    public function testIfResultIsCorrect()
    {
        $constraint = new CorrectVictoryScore();

        $team1 = new Team();
        $team1->score = 13;
        $team2 = new Team();
        $team2->score = 5;
        
        $this->validator->validate(new ArrayCollection([
            $team1,
            $team2
        ]), $constraint);

        $this->assertNoViolation();
    }
}