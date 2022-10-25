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
use Doctrine\ORM\Mapping\OrderBy;
use phpDocumentor\Reflection\Types\Integer;

#[Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[Column()]
    #[Id()]
    #[GeneratedValue()]
    public ?int $id = null;

    #[OneToMany(targetEntity: Team::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    #[OrderBy(['score' => 'DESC'])]
    #[Assert\Valid()]
    #[Assert\Count(
        min: 2,
        max: 2,
        exactMessage: 'You must specify exactly two teams',
    )]
    #[CustomAssert\CorrectVictoryScore()]
    #[CustomAssert\NoDuplicatePlayerInGame()]
    private Collection $teams;

    #[Column()]
    #[Assert\LessThan(new DateTimeImmutable())]
    public \DateTimeImmutable $playedAt;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function __toString()
    {
        if ($this->teams->count() < 2) {
            return "Game #{$this->id}";
        }

        return sprintf(
            'Game #%s (%s [winners] vs %s)',
            $this->id,
            $this->teams[0]->getSummary(),
            $this->teams[1]->getSummary(),
        );
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

    /*public function getResult(): string
    {
        $teams = $this->teams;
        return $teams[0]->getPlayersString() . ' ' . $teams[0]->score . '-' . $teams[1]->score . ' ' . $teams[1]->getPlayersString();
    }

    public function getPlayersTeam1(): Collection
    {
        $teams = $this->getTeams();
        return $teams[0]->getPlayers();
    }
    
    public function getPlayersTeam2(): Collection
    {
        $teams = $this->getTeams();
        return $teams[1]->getPlayers();
    }

    public function getScoreTeam1(): int
    {
        $teams = $this->getTeams();
        return $teams[0]->getScore();
    }

    public function getScoreTeam2(): int
    {
        $teams = $this->getTeams();
        return $teams[1]->getScore();
    }*/
}