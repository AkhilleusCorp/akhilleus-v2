<?php

namespace App\Infrastructure\Controller\Website;

use App\UseCase\Website\Authentication\AuthenticationSuccessUseCase;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AuthenticationController extends AbstractController
{
    #[Route('/authentication', name:'website_authentication', methods: ['GET', 'POST'])]
    public function authentication(AuthenticationUtils $authenticationUtils): Response
    {
        if (null !== $this->getUser()) {
            return $this->redirectToRoute('website_home');
        }

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
            '/admin', // will be base on user type
        );
    }



    #[Route('/authentication/token', name:'website_authentication_token', methods: ['GET'])]
    public function authenticationToken(JWTTokenManagerInterface $tokenManager): Response
    {
        if (null === $this->getUser())  {
            return $this->redirectToRoute('website_authentication');
        }

        return new JsonResponse(
            ['token' => $tokenManager->create($this->getUser())]
        );
    }
}