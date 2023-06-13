<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    public function __construct(private HttpClientInterface $client   )
    {
    }
    #[Route('/post', name: 'post', methods: ['POST'])]
    public function Post(Request $request): JsonResponse
    {
        $response = $this->client->request(
            'POST',
            'http://127.0.0.1:8002/api/post_blogs',[
                'json'=>json_decode($request->getContent(),true)
            ]
        );

        return $this->json([
            'Id' => json_decode($response->getContent(), true)['id']
        ]);
    }

    #[Route('/user', name: 'user', methods: ['POST'])]
    public function User(Request $request): JsonResponse
    {
        $response = $this->client->request(
            'POST',
            'http://127.0.0.1:8001/api/users',[
            'json'=>json_decode($request->getContent(),true)
            ]
        );
        return $this->json([
            'Id' => json_decode($response->getContent(), true)['id']
        ]);
    }
}
