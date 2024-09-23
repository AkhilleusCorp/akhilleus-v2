<?php

namespace App\Infrastructure\Controller\Api;

use App\Infrastructure\Registry\DataProfileRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractAPIController extends AbstractController
{
    protected function getDataProfile(): string
    {
        return DataProfileRegistry::DATA_PROFILE_ADMIN; // Todo: extract from token in the future
    }
}