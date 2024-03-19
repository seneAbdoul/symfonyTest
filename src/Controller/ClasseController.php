<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClasseController extends AbstractController
{
    #[Route('/classe/add', name: 'app_classe', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('classe/add.html.twig');
    }

    #[Route('/classe/liste', name: 'app_classe_liste', methods: ['GET'])]
    public function index1(): Response
    {
        return $this->render('classe/liste.html.twig');
    }
}
