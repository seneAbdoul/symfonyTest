<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiliereController extends AbstractController
{
    #[Route('/filiere/liste', name: 'app_filiere_liste', methods: ['GET','POST'])]
    public function index1(FiliereRepository $filiereRepository,
    PaginatorInterface $paginator,Request $request,EntityManagerInterface $manager): Response
    {
        $filieres = $paginator->paginate(
            $filiereRepository->findAll(), 
            $request->query->getInt('page', 1), 
            4 
        );

        $filiere = new Filiere(); 
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $filiere = $form->getData();
            $manager ->persist($filiere);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "filiere a ete ajouter avec succes");
                 return $this->redirectToRoute("app_filiere_liste");
        }
        return $this->render('filiere/liste.html.twig',[
            "filieres" => $filieres,
            "form"=> $form,
        ]);
    }

    #[Route('/filiere/edition/{id}', name: 'app_filiere_edit', methods: ['GET','POST'])]
    public function edit(Filiere $filiere,FiliereRepository $filiereRepository,
    PaginatorInterface $paginator,Request $request,EntityManagerInterface $manager): Response
    {
        $filieres = $paginator->paginate(
            $filiereRepository->findAll(), 
            $request->query->getInt('page', 1), 
            4
        );

        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {

            $manager ->persist($filiere);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "filiere a ete ajouter avec succes");
                 return $this->redirectToRoute("app_filiere_liste");
        }
        return $this->render('filiere/liste.html.twig',[
            "filieres" => $filieres,
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
