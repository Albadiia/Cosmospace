<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'movie')]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $overview = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column]
    private ?bool $isAdult = null;

    #[ORM\Column]
    private ?int $idAPI = null;

    #[ORM\Column]
    private ?float $voteAverage = null;

    #[ORM\Column(nullable: true)]
    private ?int $voteCount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTime $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function isAdult(): ?bool
    {
        return $this->isAdult;
    }

    public function setIsAdult(bool $isAdult): static
    {
        $this->isAdult = $isAdult;

        return $this;
    }

    public function getIdAPI(): ?int
    {
        return $this->idAPI;
    }

    public function setIdAPI(int $idAPI): static
    {
        $this->idAPI = $idAPI;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(float $voteAverage): static
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public function setVoteCount(?int $voteCount): static
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }
}
