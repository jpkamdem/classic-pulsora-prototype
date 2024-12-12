<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[Assert\Expression(
        "this.getTeamOne() != this.getTeamTwo()",
        message: "Les deux équipes doivent être différentes."
    )]

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
        if ($teamOne === $this->teamTwo) {
            throw new \InvalidArgumentException('Les deux équipes doivent être différentes.');
        }
        $this->teamOne = $teamOne;

        return $this;
    }

    public function getTeamTwo(): ?Team
    {
        return $this->teamTwo;
    }

    public function setTeamTwo(?Team $teamTwo): static
    {
        if ($teamTwo === $this->teamOne) {
            throw new \InvalidArgumentException('Les deux équipes doivent être différentes.');
        }
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

    public function areTeamsValid(): bool
    {
        return $this->teamOne !== null && $this->teamTwo !== null && $this->teamOne !== $this->teamTwo;
    }
    public function playGame(): void
    {
        if (!$this->areTeamsValid()) {
            throw new \LogicException('Les deux équipes doivent être valides.');
        }

        $this->scoreOne = rand(0, 5);
        $this->scoreTwo = rand(0, 5);
    }
}
