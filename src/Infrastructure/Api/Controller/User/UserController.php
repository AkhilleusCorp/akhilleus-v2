<?php

namespace App\Infrastructure\Api\Controller\User;

use App\Domain\DTO\User\UserDTO;
use App\Infrastructure\Api\Controller\AbstractAPIController;
use App\Infrastructure\Api\Controller\ApiBaseCrudInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractAPIController implements ApiBaseCrudInterface
{
    #[Route('/users', name:'user_get_many', methods: ['GET'])]
    public function getMany(Request $request): JsonResponse
    {
        return new JsonResponse(
            [

            ]
        );
    }

    #[Route('/users/{id}', name:'user_get_one', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(Request $request, int $id): JsonResponse
    {
        $user = new UserDTO();
        $user->id = 1;
        $user->login = 'g.host';
        $user->email = 'garry.host@fakemail.com';

        return new JsonResponse(
            $user
        );
    }

    #[Route('/users', name:'user_create_one', methods: ['POST'])]
    public function createOne(Request $request): JsonResponse
    {
        return new JsonResponse(
            [

            ]
        );
    }

    #[Route('/users/{id}', name:'user_update_one', requirements: ['id' => '\d+'], methods: ['PUT'])]
    public function updateOne(Request $request, int $id): JsonResponse
    {
        return new JsonResponse(
            [

            ]
        );
    }

    #[Route('/users/{id}', name:'user_delete_one', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteOne(Request $request, int $id): JsonResponse
    {
        return new JsonResponse(
            [

            ]
        );
    }
}