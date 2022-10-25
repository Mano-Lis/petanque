<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute()]
class NoDuplicatePlayerInGame extends Constraint
{
    public string $message = "Player cannot appear two times in a game";
}