<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ClassePlanificationRepository;
use App\Repository\SeanceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SeanceController extends AbstractController
{
    #[Route('/seance/liste', name: 'app_seance_liste', methods: ['GET','POST'])]
    public function index(Request $request,
    ClassePlanificationRepository 
    $classePlanificationRepository,
    SeanceRepository $seanceRepository,
    PaginatorInterface $paginator,EntityManagerInterface $manager): Response
    { 
        $seance = new Seance();
        $id = $request->query->getInt('id');
        $classePlanification = $classePlanificationRepository->find($id);
        $planification  = $classePlanification->getPlanification();
        $professeur = $planification ->getProfesseur();
        //dd($classePlanification);
        // dd($planification);
        //dd($professeur);
        $form = $this ->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);
        $seance ->setClassePlanification($classePlanification);
        $seance ->setEtat("planifier");
        if ($form->isSubmitted() && $form->isValid()){
            $seance = $form ->getData();
            $manager ->persist($seance);
            $manager ->flush();
            $manager->flush();
            $this ->addFlash(
                "success",
                 "seance ajouter avec succes");
                 return $this->redirectToRoute("app_seance_liste", ['id' => $classePlanification->getId()]);
        }

        $seances = $paginator ->paginate(
            $seanceRepository ->findAll(),
            $request ->query->getInt('page',1),
            3,
       );
        return $this->render('seance/liste.html.twig',[
            'classeplanification' => $classePlanification,
            'planification'=> $planification,
            'professeur'=> $professeur,
            'form'=> $form->createView(),
            'seances'=> $seances,
        ]);
    }
}
