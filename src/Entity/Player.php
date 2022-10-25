<?php 

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[Entity(repositoryClass: PlayerRepository::class)]
#[UniqueEntity('name')]
class Player
{   
    #[Column()]
    #[Id()]
    #[GeneratedValue()]
    public ?int $id = null;
    
    #[Column(unique: true)]
    #[Assert\NotBlank()]
    public string $name;

    public function __toString()
    {
        return $this->name;
    }

    // public int $score = 0;

    // public int $victories = 0;

    // public int $defeats = 0;

    // public int $rank;

    public function getName()
    {
        return $this->name;
    }
}
