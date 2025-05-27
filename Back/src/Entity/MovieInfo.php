<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'movie_info')]
#[ORM\Entity(repositoryClass: MovieInfoRepository::class)]
#[ApiResource]
class MovieInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?movie $movie = null;

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
}
