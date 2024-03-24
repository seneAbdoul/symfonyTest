<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/security/login', name: 'app_security_login', methods: ['GET','POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig',[
            'last_username'=> $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),

        ]);
    }

    #[Route('/security/logout', name: 'app_security_logout', methods: ['GET'])]
    public function logout(){
        //ntothing to do here
    }
}
