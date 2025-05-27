<?php

namespace App\Controller\Movie;

use App\Repository\MovieInfoRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MovieInfoGetController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository,
        private MovieInfoRepository $movieInfoRepository
    )
    {
        
    }
    
    public function __invoke(int $id): JsonResponse
    {
        $movie = $this->movieRepository->find($id);
        $movieInfo = $this->movieInfoRepository->find($movie);

        $data = [
            "title" => $movie->getTitle(),
            "overview" => $movie->getTitle(),
            "isAdult" => $movie->isAdult(),
            "poster" => $movie->getPoster(),
            "releaseDate" => $movie->getReleaseDate(),
            "voteAverage" => $movie->getVoteAverage(),
            "voteCount" => $movie->getVoteCount(),
            "share" => $movie->getShare(),
            "budget" => $movieInfo->getBudget(),
            "revenue" => $movieInfo->getRevenue(),
            "genre" => $movieInfo->getGenre(),
            "productionCompany" => $movieInfo->getProductionCompany(),
            "productionCountry" => $movieInfo->getProductionCountry(),
        ];
        
        return new JsonResponse($data);
    }
}
