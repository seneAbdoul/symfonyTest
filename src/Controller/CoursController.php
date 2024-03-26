<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\CoursRepository;
use App\Repository\ProfesseurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/cours/add', name: 'app_cours_add', methods: ['GET','POST'])]
    public function add(): Response
    {
        return $this->render('cours/add.html.twig');
    }

    #[Route('/cours/liste', name: 'app_cours_liste', methods: ['GET'])]
    public function liste(CoursRepository $coursRepository,PaginatorInterface $paginator,Request $request): Response
    {
         $cours = $paginator->paginate(
            $coursRepository ->findAll(),
            $request->query->getInt('page',1),
            5,
          );
        return $this->render('cours/liste.html.twig',[
            'cours'=> $cours,
        ]);
    }
    
    #[Route('/cours/listeAbsence', name: 'app_cours_listeAbsence', methods: ['GET'])]
    public function listeAbsence(Request $request,CoursRepository $coursRepository,PaginatorInterface $paginator): Response
    {
        $id = $request->query->getInt('id');
        $cour = $coursRepository->find($id);
        if($cour){
            $absencess = $cour ->getAbsences()->toArray(); 
        }
        $absences = $paginator->paginate(
            $absencess,
            $request->query->getInt('page',1),
            5,
          );
        return $this->render('cours/listeAbsence.html.twig',[
            'absences'=> $absences,
            'cour'=> $cour,
        ]);
    }
}
