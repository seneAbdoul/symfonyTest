<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiliereController extends AbstractController
{
    #[Route('/filiere/add', name: 'app_filiere', methods: ['GET','POST'])]
    public function index(Request  $request,EntityManagerInterface $manager): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);

        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($filiere);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "filiere ajouter avec succes");
                 return $this->redirectToRoute("app_filiere_liste");
        }
        return $this->render('filiere/add.html.twig',[
            "form" => $form->createView(),
        ]);
    }

    #[Route('/filiere/liste', name: 'app_filiere_liste', methods: ['GET'])]
    public function index1(FiliereRepository $filiereRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $filieres = $paginator->paginate(
            $filiereRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('filiere/liste.html.twig',[
            "filieres" => $filieres
        ]);
    }

    #[Route('/filiere/edition/{id}', name: 'app_filiere_edit', methods: ['GET','POST'])]
    public function edit(Filiere $filiere,Request $request,EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($filiere);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "filiere a ete modifier avec succes");
                 return $this->redirectToRoute("app_filiere_liste");
        }
        return $this->render('filiere/edit.html.twig',[
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/filiere/suppression/{id}', name: 'app_filiere_delete',methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Filiere $filiere): Response
    {
         $manager ->remove($filiere);
         $manager ->flush(); 
         $this ->addFlash(
            "success",
             "cette filiere a ete supprime avec succes");
             return $this->redirectToRoute("app_filiere_liste");
    }
}
