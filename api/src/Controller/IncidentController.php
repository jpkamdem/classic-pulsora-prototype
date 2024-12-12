<?php

namespace App\Controller;

use App\Entity\Incident;
use App\Repository\IncidentRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class IncidentController extends AbstractController
{
    #[Route('/api/incident', name: 'api_get_all_incidents', methods: ['GET'])]
    public function getAllIncidents(IncidentRepository $incidentRepository): JsonResponse
    {
        $incidents = $incidentRepository->findAll();

        $data = [];
        foreach ($incidents as $incident) {
            $data[] = [
                'id' => $incident->getId(),
                'type' => $incident->getType(),
                'status' => $incident->getStatus(),
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('/api/incident/{id}', name: 'api_get_one_incident', methods: ['GET'])]
    public function getOneIncident(int $id, IncidentRepository $incidentRepository): JsonResponse
    {
        $incident = $incidentRepository->find($id);

        if (!$incident) {
            return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $incident->getId(),
            'type' => $incident->getType(),
            'status' => $incident->getStatus(),
        ];

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('/api/incident', name: 'api_post_incident', methods: ['POST'])]
    public function createIncident(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $type = $data['type'];
        $status = $data['status'];

        $incident = new Incident();
        $incident->setType($type);
        $incident->setStatus($status);

        $entityManager->persist($incident);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Incident créé!'], JsonResponse::HTTP_CREATED);
    }
    #[Route('/api/incident/{id}', name: 'api_put_incident', methods: ['PUT'])]
    public function updateIncident(int $id, Request $request, IncidentRepository $incidentRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $incident = $incidentRepository->find($id);
        if (!$incident) {
            return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $incident->setType($data['type']);
        $incident->setStatus($data['status']);

        $entityManager->persist($incident);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Incident mis à jour!'], JsonResponse::HTTP_OK);
    }
    #[Route('/api/incident/{id}', name: 'api_delete_incident', methods: ['DELETE'])]
    public function deleteIncident(int $id, IncidentRepository $incidentRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $incident = $incidentRepository->find($id);
        if (!$incident) {
            return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($incident);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Incident supprimé!'], JsonResponse::HTTP_OK);
    }
    #[Route('/api/incident/', name: 'api_delete_all_incidents', methods: ['DELETE'])]
    public function deleteAllIncidents(IncidentRepository $incidentRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $incidents = $incidentRepository->findAll();
        foreach ($incidents as $incident) {
            $entityManager->remove($incident);
        }
        $entityManager->flush();

        return new JsonResponse(['status' => 'Tous les incidents ont été supprimés!'], JsonResponse::HTTP_OK);
    }
    // #[Route('/api/incident/{id}/player/{playerId}', name: 'api_add_player_to_incident', methods: ['POST'])]
    // public function addPlayerToIncident(int $incidentId, int $playerId, IncidentRepository $incidentRepository, PlayerRepository $playerRepository, EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $incident = $incidentRepository->find($incidentId);
    //     if (!$incident) {
    //         return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
    //     }

    //     $player = $playerRepository->find($playerId);
    //     if (!$player) {
    //         return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
    //     }

    //     $incident->addPlayer($player);
    //     $entityManager->persist($incident);
    //     $entityManager->flush();

    //     return new JsonResponse(['status' => 'Joueur ajouté à l\'incident!'], JsonResponse::HTTP_OK);
    // }
    // #[Route('/api/incident/{id}/player/{playerId}', name: 'api_remove_player_from_incident', methods: ['DELETE'])]
    // public function removePlayerFromIncident(int $incidentId, int $playerId, IncidentRepository $incidentRepository, PlayerRepository $playerRepository, EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $incident = $incidentRepository->find($incidentId);
    //     if (!$incident) {
    //         return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
    //     }

    //     $player = $playerRepository->find($playerId);
    //     if (!$player) {
    //         return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
    //     }

    //     $incident->removePlayer($player);
    //     $entityManager->persist($incident);
    //     $entityManager->flush();

    //     return new JsonResponse(['status' => 'Joueur retiré de l\'incident!'], JsonResponse::HTTP_OK);
    // }
}
