<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    #[Route('/security/login', name: 'app_security_login', methods: ['GET','POST'])]
    public function login(EntityManagerInterface $manager,Request $request): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/security/deconnexion', name: 'app_security_logout')]
    public function logout(){
        //ntothing to do here
    }
}
