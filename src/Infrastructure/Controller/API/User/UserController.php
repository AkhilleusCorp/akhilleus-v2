<?php

namespace App\Infrastructure\Controller\API\User;

use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use App\Infrastructure\ApiDoc;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemDataViewModel;
use App\Infrastructure\View\ViewModel\User\SingleUserDataViewModel;
use App\UseCase\API\User\CreateOneUserUseCase;
use App\UseCase\API\User\DeleteOneUserByIdUseCase;
use App\UseCase\API\User\GetManyUserUseCase;
use App\UseCase\API\User\GetOneUserByIdUseCase;
use App\UseCase\API\User\UpdateOneUserByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[ApiDoc\DocSection('USERS')]
final class UserController extends AbstractAPIController
{
    #[Route('/users', name: 'user_get_many', methods: ['GET'])]
    #[ApiDoc\GetParameters(dataClass: GetManyUsersFilterModel::class)]
    #[ApiDoc\MultipleObjectResponse(
        response: 200,
        description: 'Successfully returns a list of Users',
        dataClass: MultipleUserItemDataViewModel::class,
    )]
    public function getMany(Request $request, GetManyUserUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute(json_decode($request->getContent(), true), $this->getTokenPayload($request));
    }

    #[Route('/users/{id}', name: 'user_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully returns the details of an User',
        dataClass: SingleUserDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No User found for the given id',
    )]
    public function getOneById(Request $request, int $id, GetOneUserByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getTokenPayload($request));
    }

    #[Route('/users', name: 'user_create_one', methods: ['POST'])]
    #[ApiDoc\PostParameters(dataClass: CreateUserSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully create an User',
        dataClass: SingleUserDataViewModel::class,
    )]
    public function createOne(Request $request, CreateOneUserUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute(json_decode($request->getContent(), true), $this->getTokenPayload($request));
    }

    #[Route('/users/{id}', name: 'user_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[ApiDoc\PostParameters(dataClass: UpdateUserSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully edit the details of an User',
        dataClass: SingleUserDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No User found for the given id',
    )]
    public function updateOneById(Request $request, int $id, UpdateOneUserByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, json_decode($request->getContent(), true), $this->getTokenPayload($request));
    }

    #[Route('/users/{id}', name: 'user_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[ApiDoc\NotFoundResponse(
        description: 'No User found for the given id',
    )]
    public function deleteOneById(int $id, DeleteOneUserByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
