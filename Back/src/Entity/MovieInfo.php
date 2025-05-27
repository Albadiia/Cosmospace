<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\Movie\MovieInfoGetController;
use App\Repository\MovieInfoRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: 'movie_info')]
#[ORM\Entity(repositoryClass: MovieInfoRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['movieInfo:read', 'movie:read']],
    denormalizationContext: ['groups' => ['movieInfo:write']],
    operations: [
        new Get(
            name: 'MovieInfo',
            uriTemplate: '/movie_infos/{id}',
            controller: MovieInfoGetController::class
        ),
    ]
)]
class MovieInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['movieInfo:read'])]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?movie $movie = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?int $budget = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?int $revenue = null;

    #[ORM\Column(type: Types::JSON)]
    #[Groups(['movie:read', 'movie:write'])]
    private array $genre = [];

    #[ORM\Column(type: Types::JSON)]
    #[Groups(['movie:read', 'movie:write'])]
    private array $productionCompany = [];

    #[ORM\Column(type: Types::JSON)]
    #[Groups(['movie:read', 'movie:write'])]
    private array $productionCountry = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?movie
    {
        return $this->movie;
    }

    public function setMovie(movie $movie): static
    {
        $this->movie = $movie;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(int $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getGenre(): array
    {
        return $this->genre;
    }

    public function setGenre(array $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getProductionCompany(): array
    {
        return $this->productionCompany;
    }

    public function setProductionCompany(array $productionCompany): static
    {
        $this->productionCompany = $productionCompany;

        return $this;
    }

    public function getProductionCountry(): array
    {
        return $this->productionCountry;
    }

    public function setProductionCountry(array $productionCountry): static
    {
        $this->productionCountry = $productionCountry;

        return $this;
    }
}
