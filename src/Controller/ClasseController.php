<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use App\Repository\FiliereRepository;
use App\Repository\NiveauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClasseController extends AbstractController
{
    #[Route('/classe/add', name: 'app_classe_add', methods: ['GET','POST'])]
    public function add(Request $request,EntityManagerInterface $manager): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($classe);
            $manager->flush();
            $this ->addFlash(
                "success",
                 "classe a ete ajouter avec succes");
                 return $this->redirectToRoute("app_classe_liste");
        }
        return $this->render('classe/add.html.twig',[
            "form" => $form->createView(),
        ]);
    }

    #[Route('/classe/liste', name: 'app_classe_liste', methods: ['GET'])]
    public function liste(ClasseRepository $classeRepository,
    PaginatorInterface $paginator,
    Request $request,FiliereRepository $filiereRepository,NiveauRepository $niveauRepository): Response
    {
        $classes = $paginator->paginate(
            $classeRepository->findAll(),
            $request->query->getInt('page',1),
            5
        ) ;
        return $this->render('classe/liste.html.twig',[
            'classes'=> $classes,
            'filieres'=> $filiereRepository->findAll(),
            'niveaux' => $niveauRepository ->findAll(),
        ]);
    }
    #[Route('/classe/edition/{id}', name:'app_classe_edit', methods: ['GET','POST'])]
    public function edit(Request $request,EntityManagerInterface $manager,Classe $classe){
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($classe);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "classe a ete modifier avec succes");
                 return $this->redirectToRoute("app_classe_liste");
        }
               return $this->render('classe/edit.html.twig',[
                "form" => $form->createView(),
               ]);        
    }
    #[Route("/classe/suppression/{id}", name:"app_classe_delete", methods: ["POST","GET"])]
    public function delete(EntityManagerInterface $manager,Classe $classe){
               $manager ->remove($classe);
               $manager ->flush();
               $this ->addFlash(
                "success",
                 "classe a ete supprimer avec succes");
                 return $this->redirectToRoute("app_classe_liste");
    }
}
