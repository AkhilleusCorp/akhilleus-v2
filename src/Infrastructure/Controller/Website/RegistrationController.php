<?php

namespace App\Infrastructure\Controller\Website;

use App\Infrastructure\Registry\DataProfileRegistry;
use App\UseCase\User\CreateOneUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name:'website_registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, CreateOneUserUseCase $useCase): Response
    {
        if (Request::METHOD_POST === $request->getMethod()) {
            $user = $useCase->execute($request->request->all(), DataProfileRegistry::DATA_PROFILE_ADMIN);
        }

        return $this->render('website/pages/registration.html.twig', [
            'label' => 'Registration'
        ]);
    }
}