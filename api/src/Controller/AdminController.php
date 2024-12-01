<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/api/admin', name: 'app_get_all_admin')]
    public function index(): JsonResponse
    {
        return new JsonResponse(['message' => 'Bienvenue l\'API des admins']);
    }
}
