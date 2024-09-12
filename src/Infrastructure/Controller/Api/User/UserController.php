<?php

namespace App\Infrastructure\Controller\Api\User;

use App\Infrastructure\Controller\Api\Controller\AbstractAPIController;
use App\UseCase\User\DeleteUserUseCase;
use App\UseCase\User\GetManyUserUseCase;
use App\UseCase\User\GetOneUserUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractAPIController
{
    #[Route('/users', name:'user_get_many', methods: ['GET'])]
    public function getMany(Request $request, GetManyUserUseCase $useCase): JsonResponse
    {
        return new JsonResponse(
            $useCase->execute([])
        );
    }

    #[Route('/users/{id}', name:'user_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(int $id, GetOneUserUseCase $useCase): JsonResponse
    {
        return new JsonResponse(
            $useCase->execute($id)
        );
    }

    #[Route('/users', name:'user_create_one', methods: ['POST'])]
    public function createOne(Request $request): JsonResponse
    {
        return new JsonResponse(
            []
        );
    }

    #[Route('/users/{id}', name:'user_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    public function updateOneById(Request $request, int $id): JsonResponse
    {
        return new JsonResponse(
            [

            ]
        );
    }

    #[Route('/users/{id}', name:'user_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteOneById(int $id, DeleteUserUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}