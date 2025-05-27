<?php

namespace App\Controller\Movie;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Repository\MovieInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MoviePatchController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository,
        private EntityManagerInterface $em,
        private SerializerInterface $serializer
    )
    {
        
    }
    
    public function __invoke(Request $request, LoggerInterface $logger): JsonResponse
    {
        $movie = $this->movieRepository->find($request->get('id'));

        if (!$movie) {
            throw new NotFoundHttpException('film non trouvé');
        }

        $this->serializer->deserialize(
            $request->getContent(),
            Movie::class, //class target
            'json', //data format
            ['object_to_populate' => $movie] // data to update
        );
        
        try {
            $this->em->flush();
        } catch (\Throwable $th) {
            throw $th;
        }

        $logger->info(sprintf("🎬 Le film '%s' a été partagé.", $movie->getTitle()));
        
        return new JsonResponse('Share updated');
    }
}
