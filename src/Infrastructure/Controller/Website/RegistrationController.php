<?php

namespace App\Infrastructure\Controller\Website;

use App\Domain\Registry\User\UserTypeRegistry;
use App\UseCase\API\User\CreateOneUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'website_registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, CreateOneUserUseCase $useCase): Response
    {
        if (null !== $this->getUser()) {
            return $this->redirectToRoute('website_home');
        }

        if (Request::METHOD_POST === $request->getMethod()) {
            $request->request->set('userType', UserTypeRegistry::USER_TYPE_MEMBER);
            $useCase->execute($request->request->all());
        }

        return $this->render(
            'website/pages/registration.html.twig',
            ['context' => 'member']
        );
    }

    #[Route('/registration/coach', name: 'website_registration_coach', methods: ['GET', 'POST'])]
    public function registrationCoach(Request $request, CreateOneUserUseCase $useCase): Response
    {
        if (null !== $this->getUser()) {
            return $this->redirectToRoute('website_home');
        }

        if (Request::METHOD_POST === $request->getMethod()) {
            $request->request->set('userType', UserTypeRegistry::USER_TYPE_COACH);
            $useCase->execute($request->request->all());
        }

        return $this->render(
            'website/pages/registration_coach.html.twig',
            ['context' => 'coach']
        );
    }

    #[Route('/registration/success', name: 'website_registration_success', methods: ['GET'])]
    public function registrationSuccess(): Response
    {
        if (null !== $this->getUser()) {
            return $this->redirectToRoute('website_home');
        }

        return $this->render('website/pages/registration_success.html.twig');
    }
}
