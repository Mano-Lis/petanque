<?php 

namespace App\Validator;

use App\Entity\Team;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\Common\Collections\Collection;

class CorrectVictoryScoreValidator extends ConstraintValidator
{
    /**
     * @var Collection $teams
     */
    public function validate($teams, Constraint $constraint)
    {
        if (!$constraint instanceof CorrectVictoryScore) {
            throw new UnexpectedTypeException($constraint, CorrectVictoryScore::class);
        }

        $winningTeams = $teams->filter(fn (Team $team) => $team->score >= 13);
        $nbWinningTeams = $winningTeams->count();
        if ($nbWinningTeams < 1) {
            $this->context->buildViolation($constraint->message1)
            ->addViolation();    
        } elseif ($nbWinningTeams > 1) {
            foreach ($winningTeams as $i => $winningTeam) {
                $this->context->buildViolation($constraint->message2)
                ->atPath("[$i].score")
                ->addViolation();    
            }
        }

        /*$found = false;
        foreach ($teams as $team) {
            if ($team->score === 13) {
                if ($found) {
                    $this->context->buildViolation($constraint->message2)
                    ->addViolation();


                    break;
                }
                $found = true;
            }
        }

        if (!$found) {
                $this->context->buildViolation($constraint->message1)
                    ->addViolation();    
        }

        $i = 0;
        foreach ($teams as $team) {
            if ($team->score === 13) {
                $i++;
            }
        }

        if ($i < 1) {
            $this->context->buildViolation($constraint->message1)
                ->addViolation();
        }
        if ($i > 1) {
            $this->context->buildViolation($constraint->message2)
                ->addViolation();
        }*/

        // if ($teams[0]->score === $teams[1]->score) {
        //     $this->context->buildViolation($constraint->message2)
        //         ->addViolation();
        // }

        // $highScore = $teams[0]->score > $teams[1]->score ? $teams[0]->score : $teams[1]->score;

        // if ($highScore !== 13) {
        //     $this->context->buildViolation($constraint->message1)
        //         ->addViolation();
        // }
    }
}