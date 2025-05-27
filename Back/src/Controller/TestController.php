<?php

namespace App\Controller;

use App\Service\APIRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    public function __construct(
        private APIRequest $apiRequest
    ) {}

    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $movie = $this->apiRequest->request('now_playing', 'GET');
        dd($movie);

        return new Response('ok');
    }
}
