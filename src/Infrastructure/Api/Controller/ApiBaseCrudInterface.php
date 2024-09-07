<?php

namespace App\Infrastructure\Api\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface ApiBaseCrudInterface
{
    public function getMany(Request $request): JsonResponse;
    public function getOneById(Request $request, int $id): JsonResponse;
    public function createOne(Request $request): JsonResponse;
    public function updateOne(Request $request, int $id): JsonResponse;
    public function deleteOne(Request $request, int $id): JsonResponse;
}