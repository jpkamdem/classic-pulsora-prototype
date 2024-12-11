<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\IncidentRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PlayerController extends AbstractController
{
    #[Route('/api/player', name: 'api_get_all_players', methods: ['GET'])]
    public function getAllPlayers(PlayerRepository $playerRepository): JsonResponse
    {
        $players = $playerRepository->findAll();

        $data = [];
        foreach ($players as $player) {
            $data[] = [
                'id' => $player->getId(),
                'firstname' => $player->getFirstname(),
                'lastname' => $player->getLastname(),
                'position' => $player->getPosition(),
                'team' => $player->getTeam(),
                'situation' => $player->getSituation()
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('api/player/{id}', name: 'api_get_one_player', methods: ['GET'])]
    public function getOnePlayer(PlayerRepository $playerRepository, int $id): JsonResponse
    {
        $player = $playerRepository->find($id);

        if (!$player) {
            return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $player->getId(),
            'firstname' => $player->getFirstname(),
            'lastname' => $player->getLastname(),
            'position' => $player->getPosition(),
            'team' => $player->getTeam(),
            'situation' => $player->getSituation()
        ];

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('api/player', name: 'api_post_player', methods: ['POST'])]
    public function createPlayer(Request $request, EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $position = $data['position'];
        $team = $data['team'];
        $situation = $data['situation'];

        $player = new Player();
        $player->setFirstname($firstname);
        $player->setLastname($lastname);
        $player->setPosition($position);
        $player->setTeam($team);
        $player->addSituation($situation);

        $entityManagerInterface->persist($player);
        $entityManagerInterface->flush();

        return new JsonResponse(['status' => 'Joueur créé'], JsonResponse::HTTP_CREATED);
    }
    #[Route('api/player/{id]', name: 'api_put_player', methods: ['PUT'])]
    public function updatePlayer(int $id, EntityManagerInterface $entityManagerInterface, PlayerRepository $playerRepository, Request $request): JsonResponse
    {
        $player = $playerRepository->find($id);
        if (!$player) {
            return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $player->setFirstname($data['firstname']);
        $player->setLastname($data['lastname']);
        $player->setPosition($data['position']);
        $player->setTeam($data['team']);
        $player->addSituation($data['situation']);

        $entityManagerInterface->persist($player);
        $entityManagerInterface->flush();

        return new JsonResponse(['status' => 'Joueur modifié'], JsonResponse::HTTP_OK);
    }
    #[Route('api/player/{id]', name: 'api_delete_one_player', methods: ['DELETE'])]
    public function deleteOnePlayer(int $id, EntityManagerInterface $entityManagerInterface, PlayerRepository $playerRepository): JsonResponse
    {
        $player = $playerRepository->find($id);
        if (!$player) {
            return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManagerInterface->remove($player);
        $entityManagerInterface->flush();

        return new JsonResponse(['status' => 'Joueur supprimé'], JsonResponse::HTTP_OK);
    }
    #[Route('api/player', name: 'api_delete_all_players', methods: ['DELETE'])]
    public function deleteAllPlayers(EntityManagerInterface $entityManagerInterface, PlayerRepository $playerRepository): JsonResponse
    {
        $players = $playerRepository->findAll();

        foreach ($players as $player) {
            $entityManagerInterface->remove($player);
        }

        $entityManagerInterface->flush();

        return new JsonResponse(['status' => 'Joueurs supprimés'], JsonResponse::HTTP_OK);
    }
    #[Route('api/player/{id}/situation/{situationId}', name: 'api_add_situation_to_player', methods: ['POST'])]
    public function addSituationToPlayer(int $incidentId, int $playerId, EntityManagerInterface $entityManagerInterface, PlayerRepository $playerRepository, IncidentRepository $incidentRepository)
    {
        $player = $playerRepository->find($playerId);
        if (!$player) {
            return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $incident = $incidentRepository->find($incidentId);
        if (!$incident) {
            return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $player->addSituation($incident);

        $entityManagerInterface->persist($player);
        $entityManagerInterface->flush();

        return new JsonResponse(['status' => 'Situation ajoutée au joueur'], JsonResponse::HTTP_OK);
    }
    #[Route('api/player/{id}/situation/{situationId}', name: 'api_remove_situation_from_player', methods: ['DELETE'])]
    public function removeSituationFromPlayer(int $incidentId, int $playerId, EntityManagerInterface $entityManagerInterface, PlayerRepository $playerRepository, IncidentRepository $incidentRepository)
    {
        $player = $playerRepository->find($playerId);
        if (!$player) {
            return new JsonResponse(['status' => 'Joueur non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $incident = $incidentRepository->find($incidentId);
        if (!$incident) {
            return new JsonResponse(['status' => 'Incident non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $player->removeSituation($incident);

        $entityManagerInterface->persist($player);
        $entityManagerInterface->flush();

        return new JsonResponse(['status' => 'Situation retirée du joueur'], JsonResponse::HTTP_OK);
    }
}
