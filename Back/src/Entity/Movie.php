<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MovieRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\Movie\MoviePatchController;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: 'movie')]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['movie:read']],
    denormalizationContext: ['groups' => ['movie:write']],
    operations: [
        new GetCollection(),
        new Patch(
            name: 'Movie',
            uriTemplate: '/movies/{id}',
            controller: MoviePatchController::class
        )
    ]
)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['movie:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?string $overview = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?bool $isAdult = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?int $idAPI = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?float $voteAverage = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?int $voteCount = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?string $poster = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?int $share = 0;

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

    public function getShare(): ?int
    {
        return $this->share;
    }

    public function setShare(int $share): static
    {
        $this->share = $share;

        return $this;
    }
}
