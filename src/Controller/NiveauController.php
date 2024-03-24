<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use App\Repository\NiveauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NiveauController extends AbstractController
{
    #[Route('/niveau/liste', name: 'app_niveau_liste', methods: ['GET','POST'])]
    public function index1(NiveauRepository $niveauRepository,
    Request $request,
    PaginatorInterface $paginator,EntityManagerInterface $manager): Response
    {
          $niveaux = $paginator->paginate(
            $niveauRepository->findAll(),
            $request->query->getInt('page', 1),
            5 
        );
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $niveau = $form ->getData(); 
           $manager ->persist($niveau);
           $manager->flush();
           $this ->addFlash(
            "success",
             "cette niveau a ete ajouter avec succes");
             return $this->redirectToRoute("app_niveau_liste");
       }
        return $this->render('niveau/liste.html.twig',[
            'niveaux'=> $niveaux,
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/niveau/edition/{id}', name: 'app_niveau_edit', methods: ['GET','POST'])]
    public function edit(NiveauRepository $niveauRepository,
    Request $request,Niveau $niveau,PaginatorInterface $paginator,EntityManagerInterface $manager){
                $niveaux = $paginator->paginate(
                    $niveauRepository->findAll(),
                    $request->query->getInt('page',1),
                    5
                );
                $form = $this->createForm(NiveauType::class, $niveau);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $manager ->persist($niveau);
                        $manager->flush();
                        $this ->addFlash(
                            "success",
                             "cette niveau a ete modifier avec succes");
                             return $this->redirectToRoute("app_niveau_liste");
                }
              return $this->render('niveau/liste.html.twig',[
                'niveaux'=> $niveaux,
                'form'=> $form->createView(),
              ]);
    }

    #[Route('/niveau/suppression/{id}', name: 'app_niveau_delete', methods: ['GET'])]
    public function delete(Niveau $niveau, EntityManagerInterface $manager){
             $manager ->remove($niveau);
             $manager ->flush();
             $this ->addFlash(
                "success",
                 "cette niveau a ete supprimé avec succes");
                 return $this->redirectToRoute("app_niveau_liste");
    }
}
