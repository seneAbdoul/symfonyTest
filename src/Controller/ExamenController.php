<?php

namespace App\Controller;

use App\Entity\Examen;
use App\Form\ExamenType;
use App\Repository\ExamenRepository;
use App\Repository\ModuleRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class ExamenController extends AbstractController
{
    #[Route('/examen/liste', name: 'app_examen_liste',methods: ['GET','POST'])]
    public function liste(PaginatorInterface $paginator,Request $request,ExamenRepository $examenRepository,ProfesseurRepository $professeurRepository,ModuleRepository $moduleRepository): Response
    {
        $examens = $paginator->paginate(
            $examenRepository->findAll(), 
            $request->query->getInt('page', 1), 
            2 
        );
        $modules = $moduleRepository->findAll();
        $professeurs = $professeurRepository->findAll();
        return $this->render('examen/liste.html.twig',[
            "professeurs" => $professeurs,
            "examens" => $examens,
            "modules" => $modules
        ]);
    }

    #[Route('/examen/add', name: 'app_examen_add',methods: ['GET','POST'])]
    public function add(Request $request,EntityManagerInterface $manager): Response
    {
        $examen = new Examen(); 
        $classes = $examen->getClasses();
        $filieres = $examen->getFilieres();
        $professeurs = $examen->getProfesseurs();
        $modules = $examen->getModules();
        $form = $this->createForm(ExamenType::class, $examen);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $examen= $form->getData();
            $manager->persist($examen);
            $manager->flush();
            $this ->addFlash(
                "success",
                 "examen a ete programmer avec succes");
                 return $this->redirectToRoute("app_examen_liste");  
        }
        return $this->render('examen/add.html.twig',[
            "form"=> $form,
        ]);
    }

    #[Route('/examen/edition/{id}', name: 'app_examen_edit', methods: ['GET','POST'])]
    public function edit(Examen $examen,ExamenRepository $examenRepository,ProfesseurRepository $professeurRepository,ModuleRepository $moduleRepository,
    PaginatorInterface $paginator,Request $request,EntityManagerInterface $manager): Response
    {
        $examens = $paginator->paginate(
            $examenRepository->findAll(), 
            $request->query->getInt('page', 1), 
            2 
        );
        $modules = $moduleRepository->findAll();
        $professeurs = $professeurRepository->findAll();
        $form = $this->createForm(ExamenType::class, $examen);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($examen);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "filiere a ete modifier avec succes");
                 return $this->redirectToRoute("app_examen_liste");
        }
        return $this->render('examen/edit.html.twig',[
            "professeurs" => $professeurs,
            "examens" => $examens,
            "modules" => $modules,
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/examen/suppression/{id}', name: 'app_examen_delete',methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Examen $examen): Response
    {
         $manager ->remove($examen);
         $manager ->flush(); 
         $this ->addFlash(
            "success",
             "cette examen a ete supprime avec succes");
             return $this->redirectToRoute("app_examen_liste");
    }
}
