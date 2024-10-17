<?php

namespace App\Infrastructure\Controller\API\User;

use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\User\SingleUserDataViewModel;
use App\UseCase\API\User\CreateOneUserUseCase;
use App\UseCase\API\User\DeleteOneUserByIdUseCase;
use App\UseCase\API\User\GetManyUserUseCase;
use App\UseCase\API\User\GetOneUserByIdUseCase;
use App\UseCase\API\User\UpdateOneUserByIdUseCase;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag('USERS')]
final class UserController extends AbstractAPIController
{
    #[Route('/users', name: 'user_get_many', methods: ['GET'])]
    #[OA\Parameter(name: 'ids', in: 'query', required: false, schema: new OA\Schema(type: 'array', items: new OA\Items(type: 'integer')))]
    #[OA\Parameter(name: 'username', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'email', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'type', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: UserTypeRegistry::USER_TYPES))]
    #[OA\Parameter(name: 'status', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: UserStatusRegistry::USER_STATUSES))]
    #[OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'number'))]
    #[OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: 200,
        description: 'Successfully returns a list of Users',
        content: new Model(type: MultipleObjectViewModel::class)
    )]
    public function getMany(Request $request, GetManyUserUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($request->query->all(), $this->getDataProfile());
    }

    #[Route('/users/{id}', name: 'user_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successfully returns a details of a User',
        content: new Model(type: SingleUserDataViewModel::class)
    )]
    public function getOneById(int $id, GetOneUserByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getDataProfile());
    }

    #[Route('/users', name: 'user_create_one', methods: ['POST'])]
    #[OA\Response(
        response: 200,
        description: 'Successfully returns a details of a User',
        content: new Model(type: SingleUserDataViewModel::class)
    )]
    public function createOne(Request $request, CreateOneUserUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute(json_decode($request->getContent(), true), $this->getDataProfile());
    }

    #[Route('/users/{id}', name: 'user_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[OA\Response(
        response: 200,
        description: 'Successfully returns a details of a User',
        content: new Model(type: SingleUserDataViewModel::class)
    )]
    public function updateOneById(int $id, Request $request, UpdateOneUserByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, json_decode($request->getContent(), true), $this->getDataProfile());
    }

    #[Route('/users/{id}', name: 'user_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[OA\Response(
        response: 200,
        description: 'Successfully returns a details of a User',
    )]
    public function deleteOneById(int $id, DeleteOneUserByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
