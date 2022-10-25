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
use Doctrine\ORM\Mapping\OrderBy;
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
    //#[JoinColumn(nullable: false)]
    public Game $game;

    #[ManyToMany(targetEntity: Player::class, cascade: ['persist'])]
    #[OrderBy(['name' => 'ASC'])]
    #[Assert\Valid()]
    #[Assert\Count(
        min: 1,
        max: 3,
        minMessage: 'You must specify at least one player per team',
        maxMessage: 'You cannot specify more than three players'
    )]
    private Collection $players;

    #[Column(nullable: true)]
    #[Assert\PositiveOrZero()]
    public int $score;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf('Team #%s (%s)', $this->id, $this->getSummary());
    }

    public function getSummary(): string
    {
        return implode(', ', $this->players->map(fn (Player $p) => $p->name)->toArray());
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

    /*public function getPlayersString(): string
    {
        $playersName = [];
        foreach ($this->players as $player) {
            $playersName[] = $player->name;
            //$playerName = $player->name;
            //array_push($playersName, $playerName);
        }
        return implode(',', $playersName);
    }*/

    //return implode(',', array_map(fn ($player) => $player->name, $this->players));

    public function getScore(): int
    {
        return $this->score;
    }
}
