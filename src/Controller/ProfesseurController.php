<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur/add', name: 'app_professeur',methods: ['GET',"POST"])]
    public function index(Request  $request,EntityManagerInterface $manager): Response
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);

        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($professeur);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "professeur ajouter avec succes");
                 return $this->redirectToRoute("app_professeur_liste");
        }
        return $this->render('professeur/add.html.twig',[
            "form" => $form->createView(),
        ]);
    }

    #[Route('/professeur/liste', name: 'app_professeur_liste',methods: ['GET'])]
    public function index1(ProfesseurRepository $professeurRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $professeurs = $paginator->paginate(
            $professeurRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('professeur/liste.html.twig', [
            'professeurs'=> $professeurs
        ]);
    }

    #[Route('/professeur/edition/{id}', name: 'app_professeur_edit',methods: ['GET','POST'])]
    public function edit(Professeur $professeur,Request $request,EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($professeur);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "professeur a ete modifie avec succes");
                 return $this->redirectToRoute("app_professeur_liste");
        }        
        return $this->render('professeur/edit.html.twig',[
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/professeur/suppression/{id}', name: 'app_professeur_delete',methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Professeur $professeur): Response
    {
         $manager ->remove($professeur);
         $manager ->flush(); 
         $this ->addFlash(
            "success",
             "professeur a ete supprime avec succes");
             return $this->redirectToRoute("app_professeur_liste");
    }
}
