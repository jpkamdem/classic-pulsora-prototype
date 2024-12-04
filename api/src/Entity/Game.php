<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamOne = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamTwo = null;

    #[ORM\Column]
    private ?int $scoreOne = null;

    #[ORM\Column]
    private ?int $scoreTwo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamOne(): ?Team
    {
        return $this->teamOne;
    }

    public function setTeamOne(?Team $teamOne): static
    {
        $this->teamOne = $teamOne;

        return $this;
    }

    public function getTeamTwo(): ?Team
    {
        return $this->teamTwo;
    }

    public function setTeamTwo(?Team $teamTwo): static
    {
        $this->teamTwo = $teamTwo;

        return $this;
    }

    public function getScoreOne(): ?int
    {
        return $this->scoreOne;
    }

    public function setScoreOne(int $scoreOne): static
    {
        $this->scoreOne = $scoreOne;

        return $this;
    }

    public function getScoreTwo(): ?int
    {
        return $this->scoreTwo;
    }

    public function setScoreTwo(int $scoreTwo): static
    {
        $this->scoreTwo = $scoreTwo;

        return $this;
    }
}
