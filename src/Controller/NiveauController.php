<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NiveauController extends AbstractController
{
    #[Route('/niveau/add', name: 'app_niveau', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('niveau/add.html.twig');
    }

    #[Route('/niveau/liste', name: 'app_niveau_liste', methods: ['GET'])]
    public function index1(): Response
    {
        return $this->render('niveau/liste.html.twig');
    }
}
