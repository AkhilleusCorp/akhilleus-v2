<?php

namespace App\Infrastructure\Controller\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name:'website_registration')]
    public function index(): Response
    {
        return $this->render('website/pages/registration.html.twig', [
            'label' => 'Registration'
        ]);
    }
}