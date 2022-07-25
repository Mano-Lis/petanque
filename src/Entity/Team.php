<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;
use phpDocumentor\Reflection\Types\Nullable;

#[Entity(repositoryClass: TeamRepository::class)]
class Team 
{
    #[Column()]
    #[Id]
    #[GeneratedValue()]
    public ?int $id = null;

    #[ManyToOne(targetEntity: Game::class, inversedBy: 'teams')]
    #[JoinColumn(nullable: false)]
    public Game $game;

    #[ManyToMany(targetEntity: Player::class, cascade: ['persist'])]
    #[Assert\Valid()]
    private Collection $players;

    #[Column(nullable: true)]
    #[Assert\PositiveOrZero()]
    public int $score;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function addPlayer(Player $player)
    {
        $this->players->add($player);
    }

    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    public function getPlayers(): Collection
    {
        return $this->players;
    }
}
