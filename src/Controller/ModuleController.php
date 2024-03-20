<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module/liste', name: 'app_module_liste', methods: ['GET','POST'])]
    public function liste(ModuleRepository $moduleRepository,PaginatorInterface $paginator,
    Request $request,EntityManagerInterface $manager): Response
    {
        $modules = $paginator->paginate(
            $moduleRepository->findAll(),
            $request->query->getInt('page', 1),
            5 
        );
        $module = new Module();
         $form = $this->createForm(ModuleType::class, $module);
         $form->handleRequest($request);
         if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($module);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "module a ete ajouter avec succes");
                 return $this->redirectToRoute("app_module_liste");
        }
        
        return $this->render('module/liste.html.twig',[
            'modules'=> $modules,
            'form'=> $form->createView(),   
        ]);
    }


    #[Route('/module/edition/{id}', name: 'app_module_edit', methods: ['GET','POST'])]
    public function edit(ModuleRepository $moduleRepository,PaginatorInterface $paginator,
    Request $request,EntityManagerInterface $manager,Module $module){
                
        $modules = $paginator->paginate(
            $moduleRepository->findAll(),
            $request->query->getInt('page', 1),
            5 
        );

         $form = $this->createForm(ModuleType::class, $module);
         $form->handleRequest($request);
         if($form ->isSubmitted() && $form->isValid()) {
            $manager ->persist($module);
            $manager ->flush();
            $this ->addFlash(
                "success",
                 "module a ete modifier avec succes");
                 return $this->redirectToRoute("app_module_liste");
        }
        
        return $this->render('module/liste.html.twig',[
            'modules'=> $modules,
            'form'=> $form->createView(),   
        ]);
    }

    #[Route('/module/supression/{id}', name: 'app_module_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Module $module){
        $manager ->remove($module);
        $manager ->flush(); 
        $this ->addFlash(
            "success",
             "cette module a ete supprime avec succes");
            return $this->redirectToRoute("app_module_liste");
    }
}
