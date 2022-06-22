<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[Column()]
    #[Id()]
    #[GeneratedValue()]
    public int $id;

    #[OneToMany(targetEntity: Team::class, mappedBy: 'game')]
    public Collection $teams;

    #[Column()]
    public \DateTimeImmutable $playedAt;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function addTeam(Team $team)
    {
        $this->teams->add($team);
    }

    public function removeTeam(Team $team)
    {
        $this->teams->removeElement($team);
    }
}