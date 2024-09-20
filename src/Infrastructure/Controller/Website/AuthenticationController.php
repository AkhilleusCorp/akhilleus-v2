<?php

namespace App\Infrastructure\Controller\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthenticationController extends AbstractController
{
    #[Route('/authentication', name:'website_authentication')]
    public function index(): Response
    {
        return $this->render('website/pages/authentication.html.twig', [
            'label' => 'Authentication'
        ]);
    }
}