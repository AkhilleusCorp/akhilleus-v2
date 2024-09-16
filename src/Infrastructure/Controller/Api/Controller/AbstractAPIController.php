<?php

namespace App\Infrastructure\Controller\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractAPIController extends AbstractController
{
    protected function getDataProfile(Request $request): string
    {
        return 'admin'; // Todo: extract from token in the future
    }
}