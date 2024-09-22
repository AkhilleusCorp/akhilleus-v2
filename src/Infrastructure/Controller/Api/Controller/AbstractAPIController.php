<?php

namespace App\Infrastructure\Controller\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractAPIController extends AbstractController
{
    protected function getDataProfile(): string
    {
        return 'admin'; // Todo: extract from token in the future
    }
}