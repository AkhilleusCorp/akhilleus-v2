<?php

namespace App\Infrastructure\Controller\Website;

use App\UseCase\Authentication\AuthenticationSuccessUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AuthenticationController extends AbstractController
{
    #[Route('/authentication', name:'website_authentication', methods: ['GET', 'POST'])]
    public function authentication(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('website/pages/authentication.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername
        ]);
    }

    #[Route('/authentication/success', name:'website_authentication_success', methods: ['GET'])]
    public function authenticationSuccess(AuthenticationSuccessUseCase $useCase): RedirectResponse
    {
        $useCase->execute($this->getUser());

        return new RedirectResponse(
            '/admin',
        );
    }
}