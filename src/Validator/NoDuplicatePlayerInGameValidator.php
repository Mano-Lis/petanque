<?php

namespace App\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Game;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;

class NoDuplicatePlayerInGameValidator extends ConstraintValidator
{
    // public function validate($game, Constraint $constraint)
    // {
    //     if (!$constraint instanceof NoDuplicatePlayerInGame) {
    //         throw new UnexpectedTypeException($constraint, NoDuplicatePlayerInGame::class);
    //     }
        
    //     $playersInGame = [];
    //     foreach ($game->getTeams() as $team) {
    //         foreach ($team->getPlayers() as $player) {
    //             $playersInGame[] = $player;
    //         }
    //     }

    //     if (array_unique($playersInGame, SORT_REGULAR) !== $playersInGame) {
    //         $this->context->buildViolation($constraint->message)
    //         ->addViolation();
    //     }
    // }

    public function validate($teams, Constraint $constraint)
    {
        if (!$constraint instanceof NoDuplicatePlayerInGame) {
            throw new UnexpectedTypeException($constraint, NoDuplicatePlayerInGame::class);
        }
        
        $playersInGame = [];
        foreach ($teams as $i => $team) {
            foreach ($team->getPlayers() as $player) {
                if ($matched = isset($playersInGame[$player->id])) {
                    [$duplicatedI, $alreadyMatched] = $playersInGame[$player->id];

                    if (!$alreadyMatched) {
                        $this->context
                            ->buildViolation($constraint->message)
                            ->atPath("[$duplicatedI].players[{$player->id}]")
                            ->addViolation();
                    }

                    $this->context
                        ->buildViolation($constraint->message)
                        ->atPath("[$i].players[{$player->id}]")
                        ->addViolation();
                }
    

                $playersInGame[$player->id] = [$i, $matched];
                // var_dump($playersInGame[$player->id]);
            }
        }
    }
}
