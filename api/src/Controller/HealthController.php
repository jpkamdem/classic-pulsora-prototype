<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthController extends AbstractController
{
    #[Route('/api/health', name: 'api_get_health', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse(['message' => 'API is running fine']);
    }
}
