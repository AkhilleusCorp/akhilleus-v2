<?php

namespace App\Infrastructure\Controller\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AuthenticationController extends AbstractController
{
    #[Route('/authentication', name:'website_authentication', methods: ['GET', 'POST'])]
    public function authentication(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('website/pages/authentication.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername
        ]);
    }
}