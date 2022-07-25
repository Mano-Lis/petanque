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
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as CustomAssert;
use DateTimeImmutable;

#[Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[Column()]
    #[Id()]
    #[GeneratedValue()]
    public ?int $id = null;

    #[OneToMany(targetEntity: Team::class, mappedBy: 'game', cascade: ['persist'])]
    #[Assert\Valid()]
    #[CustomAssert\CorrectVictoryScore()]
    private Collection $teams;

    #[Column()]
    #[Assert\LessThan(new DateTimeImmutable())]
    public \DateTimeImmutable $playedAt;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addTeam(Team $team): void
    {
        $this->teams->add($team);
        $team->game = $this;
    }

    public function removeTeam(Team $team): void
    {
        $this->teams->removeElement($team);
        $team->game = null;
    }

    public function getTeams(): Collection
    {
        return $this->teams;
    }
}