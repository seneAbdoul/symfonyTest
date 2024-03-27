<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResponsableController extends AbstractController
{
    #[Route('/responsable/add', name: 'app_responsable_add', methods: ['GET','POST'])]
    public function add(Request $request,EntityManagerInterface $manager): Response
    {
        $responsable = new Responsable();
        $responsable->setRoles(["ROLE_RP"]);
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $responsable = $form->getData();
            $manager->persist($responsable);
            $manager->flush();
            $this ->addFlash(
                "success",
                 "responsable ajouter avec succes");
                 return $this->redirectToRoute("app_responsable_liste");
        }
        return $this->render('responsable/add.html.twig',[
              'form'=> $form,
        ]);
    }
    #[Route('/responsable/liste', name:'app_responsable_liste', methods: ['GET'])]
         public function liste(){
            return $this->render('responsable/liste.html.twig');
         }
}
