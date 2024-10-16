<?php

namespace App\Infrastructure\Controller\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'website_home')]
    public function index(): Response
    {
        return $this->render('website/pages/home.html.twig', [
            'label' => 'Home',
        ]);
    }
}
