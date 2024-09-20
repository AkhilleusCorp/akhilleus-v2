<?php

namespace App\Infrastructure\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/{reactRouting}', name:'admin_index', requirements: ['reactRouting' => '^(?!api).+'], defaults: ['reactRouting' => null])]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig',);
    }
}
