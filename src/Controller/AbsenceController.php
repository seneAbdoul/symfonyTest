<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Form\AbsenceType;
use App\Repository\AbsenceRepository;
use App\Repository\ClasseRepository;
use App\Repository\CoursRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
    public function liste(PaginatorInterface $paginator, 
    Request $request,
    AbsenceRepository $absenceRepository,
    EtudiantRepository $etudiantRepository,
    CoursRepository $coursRepository): Response
    {
        $cours = $coursRepository ->findAll();
        $etudiants = $etudiantRepository ->findAll();
        $absences = $paginator ->paginate(
            $absenceRepository ->findAll(), 
            $request->query->getInt('page',1),
            5
             ) ;
        return $this->render('absence/liste.html.twig',[
            'cours'=> $cours,
            'etudiants'=> $etudiants,
            'absents'=> $absences
        ]);
    }
}
