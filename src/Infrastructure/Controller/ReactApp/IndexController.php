<?php

namespace App\Infrastructure\Controller\ReactApp;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/admin/{reactRouting}', name: 'admin_index', requirements: ['reactRouting' => '^(?!api).+'], defaults: ['reactRouting' => null])]
    public function admin(): Response
    {
        return $this->render('admin/admin.html.twig');
    }

    #[Route('/member/{reactRouting}', name: 'member_index', requirements: ['reactRouting' => '^(?!api).+'], defaults: ['reactRouting' => null])]
    public function member(): Response
    {
        return $this->render('member/member.html.twig');
    }
}
