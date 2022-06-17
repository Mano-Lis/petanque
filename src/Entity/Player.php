<?php 

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity(repositoryClass: PlayerRepository::class)]
class Player
{   
    #[Column()]
    #[Id()]
    #[GeneratedValue()]
    public int $id;
    
    #[Column()]
    public string $name;

    // public int $score = 0;

    // public int $victories = 0;

    // public int $defeats = 0;

    // public int $rank;
}