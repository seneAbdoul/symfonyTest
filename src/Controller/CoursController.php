<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Etudiant;
use App\Form\CourType;
use App\Repository\CoursRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoursController extends AbstractController
{
    #[Route('/cours/liste', name: 'app_cours_liste', methods: ['GET','POST'])]
    public function liste(CoursRepository $coursRepository,
    PaginatorInterface $paginator,
    Request $request,EntityManagerInterface $manager): Response
    {
        $cour = new Cours();
         $cours = $paginator->paginate(
            $coursRepository ->findAll(),
            $request->query->getInt('page',1),
            4,
          );
          $cour ->setEtat('en attente');
          $form = $this->createForm(CourType::class, $cour);
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
            $cour = $form->getData();
            $manager ->persist($cour);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "cours ajouter avec succes");
                 return $this->redirectToRoute("app_cours_liste");
          }
        return $this->render('cours/liste.html.twig',[
            'cours'=> $cours,
            'form'=> $form->createView(),
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

    #[Route('/cours/edition/{id}', name: 'app_cours_edit', methods: ['GET','POST'])]
    public function edit(CoursRepository $coursRepository,
    PaginatorInterface $paginator,
    Request $request,EntityManagerInterface $manager,Cours $cour){

        $cours = $paginator->paginate(
           $coursRepository ->findAll(),
           $request->query->getInt('page',1),
           4,
         );
         $cour ->setEtat('en attente');
         $form = $this->createForm(CourType::class, $cour);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
           $cour = $form->getData();
           $manager ->persist($cour);
           $manager ->flush();
           $this ->addFlash(
               "success",
                "cours modifier avec succes");
                return $this->redirectToRoute("app_cours_liste");
         }
       return $this->render('cours/liste.html.twig',[
           'cours'=> $cours,
           'form'=> $form->createView(),
       ]);

    }
    #[Route('/cours/supression/{id}', name: 'app_cours_delete', methods: ['GET','POST'])]
    public function delete(Cours $cour,EntityManagerInterface $manager){
        $manager ->remove($cour);
        $manager ->flush(); 
        $this ->addFlash(
           "success",
            "cours supprimer avec succes");
            return $this->redirectToRoute("app_cours_liste");
    }

}
