<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TeamController extends AbstractController
{
    #[Route('api/team', name: 'api_get_all_teams', methods: ['GET'])]
    public function getAllTeams(TeamRepository $teamRepository): JsonResponse
    {
        $teams = $teamRepository->findAll();
        $data = [];

        foreach ($teams as $team) {
            $players = [];

            foreach ($team->getPlayers() as $player) {
                $players[] = [
                    'id' => $player->getId(),
                    'firstname' => $player->getFirstname(),
                    'lastname' => $player->getLastname(),
                    'position' => $player->getPosition(),
                    'situation' => $player->getSituation()
                ];
            }
            $data[] = [
                'name' => $team->getName(),
                'wins' => $team->getWins(),
                'loses' => $team->getLoses(),
                'players' => $players
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
