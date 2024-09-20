<?php

namespace App\Infrastructure\Controller\Admin;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/{reactRouting}', name:'admin_index', requirements: ['reactRouting' => '^(?!api).+'], defaults: ['reactRouting' => null])]
    public function index(JWTTokenManagerInterface $tokenManager): Response
    {
        if ($user = $this->getUser()) {
            $token = $tokenManager->create($user);
            return $this->render(
                'admin/admin.html.twig',
                [],
                new Response(null, Response::HTTP_OK, [
                    'Authorization' => "Bearer: $token"
                ])
            );
        }

        return $this->redirectToRoute('website_authentication');
    }
}
