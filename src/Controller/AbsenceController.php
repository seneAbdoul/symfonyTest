<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Form\AbsenceType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbsenceController extends AbstractController
{
    #[Route('/absence/add', name: 'app_absence_add', methods: ['GET','POST'])]
    public function add(): Response
    {
        return $this->render('absence/add.html.twig');
       
    }
  
    #[Route('/absence/liste', name: 'app_absence_liste', methods: ['GET'])]
    public function liste(): Response
    {
        return $this->render('absence/liste.html.twig');
    }
}
