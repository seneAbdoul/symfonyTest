<?php

namespace App\Controller;

use App\Entity\Planification;
use App\Form\PlanificationType;
use App\Entity\PlanificationClasse;
use App\Repository\ClasseRepository;
use App\Repository\ModuleRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PlanificationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PlanificationClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanificationController extends AbstractController
{
    #[Route('/planification/add', name: 'app_planification_add', methods: ['GET','POST'])]
    public function add(Request $request,EntityManagerInterface $em): Response
    {
        $planification = new Planification();
        $planification ->setHeureFait(0);
        $form = $this->createForm(PlanificationType::class, $planification);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $planification = $form->getData();
             $em->persist($planification);
             $em->flush();
             $this ->addFlash(
                "success",
                 "professeur ajouter avec succes");
                 return $this->redirectToRoute("app_planification_liste");
        }
        return $this->render('planification/add.html.twig',[
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/planification/liste', name: 'app_planification_liste', methods: ['GET'])]
    public function liste(PlanificationRepository $planificationRepository,
     PaginatorInterface $paginator,
     Request $request,ModuleRepository $moduleRepository,
     ProfesseurRepository $professeurRepository): Response
    {
        $planifications = $paginator ->paginate(
            $planificationRepository->findAll(),
            $request->query->getInt('page', 1), 
            5  
        );
        return $this->render('planification/liste.html.twig',[
            'planifications'=> $planifications,
            'professeurs'=> $professeurRepository->findAll(),
            'modules' => $moduleRepository->findAll(),  
        ]);
    }
    #[Route('/planification/detail', name: 'app_planification_detail', methods: ['GET'])]
    public function detail(Request $request,
     PlanificationRepository $planificationRepository,PaginatorInterface $paginator): Response
    {
        $id = $request->query->get('id');
        $planification = $planificationRepository->find($id);

        if ($planification) {
            $classess = $planification->getClasses()->toArray(); 
        } 
        $classes = $paginator->paginate(
            $classess  ,
            $request->query->getInt('page',1),
            5
        ) ;
        return $this->render('planification/detail.html.twig',[
            'classes'=> $classes,
            'planification'=> $planification,
        ]);
    }

    #[Route('/planification/listeEtudiant', name: 'app_planification_listeEtudiant', methods: ['GET'])]
    public function listeEtudiant(Request $request,
    ClasseRepository $classeRepository, PaginatorInterface $paginator): Response
    {
        $id = $request->query->get('id');
        $classe = $classeRepository->find($id);

        if ($classe) {
            $etudiantss = $classe->getInscriptions()->toArray(); 
        } 
        $etudiants = $paginator->paginate(
            $etudiantss,
            $request->query->getInt('page',1),
            5
        ) ;

        return $this->render('planification/listeEtudiant.html.twig',[
            'etudiants'=> $etudiants,
            'classe'=> $classe
        ]);
    }
}
