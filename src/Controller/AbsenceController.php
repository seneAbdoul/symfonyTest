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
    public function add(Request $request,EntityManagerInterface $manager,ClasseRepository $classeRepository): Response
    {
        $idclase = $request->query->get('id');
        $classe = $classeRepository ->find($idclase);
        $absence = new Absence();
        $form = $this ->createForm(AbsenceType::class, $absence);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
        }
        return $this->render('absence/add.html.twig',[
            'form'=> $form->createView(),
        ]);
       
    }
  
    #[Route('/absence/liste', name: 'app_absence_liste', methods: ['GET'])]
    public function liste(): Response
    {
        return $this->render('absence/liste.html.twig');
    }
}
