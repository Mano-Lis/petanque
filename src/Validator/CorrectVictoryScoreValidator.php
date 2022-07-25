<?php 

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CorrectVictoryScoreValidator extends ConstraintValidator
{
    public function validate($teams, Constraint $constraint)
    {
        if (!$constraint instanceof CorrectVictoryScore) {
            throw new UnexpectedTypeException($constraint, CorrectVictoryScore::class);
        }

        if ($teams[0]->score === $teams[1]->score) {
            $this->context->buildViolation($constraint->message2)
                ->addViolation();
        }

        // if ($teams[0]->score > $teams[1]->score) {
        //     $highScore = $teams[0]->score;
        // } else {
        //     $highScore = $teams[1]->score;
        // }

        $highScore = $teams[0]->score > $teams[1]->score ? $teams[0]->score : $teams[1]->score;

        if ($highScore !== 13) {
            $this->context->buildViolation($constraint->message1)
                ->addViolation();
        }
    }
}