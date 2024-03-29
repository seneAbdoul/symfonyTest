<?php

namespace App\Controller;

use App\Entity\Planification;
use App\Form\PlanificationType;
use App\Entity\ClassePlanification;
use App\Repository\ClassePlanificationRepository;
use App\Repository\ClasseRepository;
use App\Repository\ModuleRepository;
use App\Repository\PlanificationRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanificationController extends AbstractController
{
    #[Route('/planification/add', name: 'app_planification_add', methods: ['GET','POST'])]
    public function add(Request $request,EntityManagerInterface $em): Response
    {
        $planification = new Planification();
        $classes = $planification ->getClasses();
        $form = $this->createForm(PlanificationType::class, $planification);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $planification = $form->getData();
            $em->persist($planification);
            $em->flush();
            foreach ($classes as $value) {
                $classePlanification = new ClassePlanification();
                $classePlanification->setClasse($value);
                $classePlanification->setHeureFait(0) ;
                $classePlanification ->setPlanification($planification);
                $classePlanification ->setNombreHeure($planification->getNombreHeure());
                $em ->persist($classePlanification);
                $em->flush(); 
            }
            $this ->addFlash(
                "success",
                 "cette planification a ete ajouter avec succes");
                 return $this->redirectToRoute("app_planification_liste");

        }
        return $this->render('planification/add.html.twig',[
            'form'=> $form->createView(),
        ]);
    }
    #[Route('/planification/liste', name: 'app_planification_liste', methods: ['GET'])]
    public function liste(PlanificationRepository $planificationRepository,Request $request,
    PaginatorInterface $paginator,ProfesseurRepository $professeurRepository,ModuleRepository $moduleRepository): Response
    {
        $planifications = $paginator ->paginate(
            $planificationRepository->findAll(),
            $request->query->getInt('page',1),
            5
        ) ;

        return $this->render('planification/liste.html.twig',[
            'planifications'=> $planifications,
            'professeurs' => $professeurRepository->findAll(),
            'modules'=> $moduleRepository->findAll(),
        ]);
    }

    #[Route('/planification/detail', name: 'app_planification_detail', methods: ['GET'])]
    public function detail(Request $request,
    PlanificationRepository $planificationRepository,PaginatorInterface $paginator){
        $id = $request->query->get('id');
        $planification = $planificationRepository->find($id);
        if($planification){
            $classess = $planification->getClassePlanifications()->toArray();
        }
        $classes = $paginator ->paginate(
            $classess,
            $request->query->getInt('page',1),
            5
        ) ;
       //dd($classes);
        return $this->render('planification/detail.html.twig',[
            'classes'=> $classes,
            'planification'=> $planification,

        ]);
    }

    #[Route('/planification/listeEtudiant', name: 'app_planification_listeEtudiant', methods: ['GET'])]
    public function listeEtudiant(Request $request,ClasseRepository $classeRepository,PaginatorInterface $paginator){
         $id = $request->query->get('id');
         $classe = $classeRepository->find($id);
         if($classe){
            $etudiantss = $classe->getInscriptions()->toArray();
         }
         $etudiants = $paginator ->paginate(
            $etudiantss,
            $request->query->getInt('page',1),
            5
        ) ;
         return $this->render('planification/listeEtudiant.html.twig',[
             'etudiants'=> $etudiants,
         ]) ;
    }
  
    #[Route('/planification/edition/{id}', name: 'app_planification_edit', methods: ['GET','POST'])]
    public function edit(Request $request,EntityManagerInterface $em,Planification $planification): Response
    {
        $classes = $planification ->getClasses();
        $form = $this->createForm(PlanificationType::class, $planification);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $planification = $form->getData();
            $em->persist($planification);
            $em->flush();
            foreach ($classes as $value) {
                $classePlanification = new ClassePlanification();
                $classePlanification->setClasse($value);
                $classePlanification->setHeureFait(0) ;
                $classePlanification ->setPlanification($planification);
                $classePlanification ->setNombreHeure($planification->getNombreHeure());
                $em ->persist($classePlanification);
                $em->flush(); 
            }
            $this ->addFlash(
                "success",
                 "cette planification a ete modifier avec succes");
                 return $this->redirectToRoute("app_planification_liste");

        }
        return $this->render('planification/edit.html.twig',[
            'form'=> $form->createView(),
        ]);
    }
    #[Route('/planification/suppression/{id}', name: 'app_planification_delete', methods: ['GET'])]
    public function delete(
    EntityManagerInterface $manager,Request $request,PlanificationRepository $planificationRepository){
        $id = $request->attributes->get('id');
        $planification = $planificationRepository->find($id);
        $classeplanification = $planification ->getClassePlanifications()->toArray();
        foreach ($classeplanification as $value) {
            $manager ->remove($value);
           $manager ->flush(); 
        }

        $manager ->remove($planification);
        $manager ->flush(); 

        $this ->addFlash(
           "success",
            "planification supprimer avec succes");
            return $this->redirectToRoute("app_planification_liste");             
    }
}
