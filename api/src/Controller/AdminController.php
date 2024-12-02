<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/api/admin', name: 'api_get_all_admin', methods: ['GET'])]
    public function getAllAdmins(AdminRepository $adminRepository): JsonResponse
    {
        $admins = $adminRepository->findAll();

        $data = [];
        foreach ($admins as $admin) {
            $data[] = [
                'id' => $admin->getId(),
                'username' => $admin->getUsername(),
                'password' => $admin->getPassword(),
            ];
        };

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('/api/admin/{id}', name: 'api_get_one_admin', methods: ['GET'])]
    public function getOneAdmin(AdminRepository $adminRepository, int $id): JsonResponse
    {
        $admin = $adminRepository->find($id);

        if (!$admin) {
            return new JsonResponse(['status' => 'Admin non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $admin->getId(),
            'username' => $admin->getUsername(),
            'password' => $admin->getPassword(),
        ];

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('/api/admin', name: 'api_post_admin', methods: ['POST'])]
    public function createAdmin(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'];
        $password = $data['password'];

        $admin = new Admin();
        $admin->setUsername($username);
        $admin->setPassword($password);

        $entityManager->persist($admin);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Admin créé !'], Response::HTTP_CREATED);
    }
    #[Route('/api/admin/{id}', name: 'api_put_admin', methods: ['PUT'])]
    public function updateAdmin(int $id, Request $request, EntityManagerInterface $entityManager, AdminRepository $adminRepository): JsonResponse
    {
        $admin = $adminRepository->find($id);

        if (!$admin) {
            return new JsonResponse(['status' => 'Admin non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $admin->setUsername($data['username']);
        $admin->setPassword($data['password']);

        $entityManager->persist($admin);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Admin modifié !'], Response::HTTP_OK);
    }
    #[Route('/api/admin/{id}', name: 'api_delete_one_admin', methods: ['DELETE'])]
    public function deleteOneAdmin(int $id, EntityManagerInterface $entityManager, AdminRepository $adminRepository): JsonResponse
    {
        $admin = $adminRepository->find($id);

        if (!$admin) {
            return new JsonResponse(['status' => 'Admin non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($admin);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Admin supprimé !'], Response::HTTP_OK);
    }
    #[Route('/api/admin', name: 'api_delete_all_admin', methods: ['DELETE'])]
    public function deleteAllAdmins(EntityManagerInterface $entityManager, AdminRepository $adminRepository): JsonResponse
    {
        $admins = $adminRepository->findAll();

        foreach ($admins as $admin) {
            $entityManager->remove($admin);
        }

        $entityManager->flush();

        return new JsonResponse(['status' => 'Tous les admins ont été supprimés !'], Response::HTTP_OK);
    }
}
