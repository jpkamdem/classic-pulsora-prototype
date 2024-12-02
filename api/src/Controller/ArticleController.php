<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/api/article', name: 'api_get_all_article', methods: ['GET'])]
    public function getAllArticles(ArticleRepository $articleRepository): JsonResponse
    {
        $articles = $articleRepository->findAll();

        $data = [];
        foreach ($articles as $article) {
            $data[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'body' => $article->getBody(),
            ];
        };

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('/api/article/{id}', name: 'api_get_one_article', methods: ['GET'])]
    public function getOneArticle(int $id, ArticleRepository $articleRepository): JsonResponse
    {
        $article = $articleRepository->find($id);

        if (!$article) {
            return new JsonResponse(['status' => 'Article non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'body' => $article->getBody(),
        ];

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
    #[Route('/api/article', name: 'api_post_article', methods: ['POST'])]
    public function createArticle(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $body = $data['body'];

        $article = new Article();
        $article->setTitle($title);
        $article->setBody($body);

        $entityManager->persist($article);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Article créé !'], Response::HTTP_CREATED);
    }
    #[Route('/api/article/{id}', name: 'api_put_article', methods: ['PUT'])]
    public function updateArticle(int $id, Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): JsonResponse
    {
        $article = $articleRepository->find($id);

        if (!$article) {
            return new JsonResponse(['status' => 'Article non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $article->setTitle($data['title']);
        $article->setBody($data['body']);

        $entityManager->persist($article);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Article modifié !'], Response::HTTP_OK);
    }
    #[Route('/api/article/{id}', name: 'api_delete_article', methods: ['DELETE'])]
    public function deleteOneArticle(int $id, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): JsonResponse
    {
        $article = $articleRepository->find($id);

        if (!$article) {
            return new JsonResponse(['status' => 'Article non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Article supprimé !'], Response::HTTP_OK);
    }
    #[Route('/api/article', name: 'api_delete_all_article', methods: ['DELETE'])]
    public function deleteAllArticles(EntityManagerInterface $entityManager, ArticleRepository $articleRepository): JsonResponse
    {
        $articles = $articleRepository->findAll();

        foreach ($articles as $article) {
            $entityManager->remove($article);
        }

        $entityManager->flush();

        return new JsonResponse(['status' => 'Tous les articles ont été supprimés !'], Response::HTTP_OK);
    }
}
