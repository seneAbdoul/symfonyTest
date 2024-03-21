<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Repository\AnneeScolaireRepository;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiantInscrit/liste', name: 'app_etudiant_Inscritliste', methods: ['GET'])]
    public function liste(InscriptionRepository $inscriptionRepository,
    Request $request,
    PaginatorInterface $paginator,ClasseRepository $classe): Response
    {
        $classes = $classe->findAll();
       $inscriptions = $paginator ->paginate(
            $inscriptionRepository->findAll(),
            $request->query->getInt('page',1),
            5,
        );
        return $this->render('etudiant/listeInscrit.html.twig',[
            "inscriptions" =>  $inscriptions,
            "classes" =>  $classes,
        ]);
    }

    #[Route('/etudiant/add', name: 'app_etudiant_add', methods: ['GET','POST'])]
    public function add(EntityManagerInterface $manager,
    Request $request,
    ClasseRepository $classe,AnneeScolaireRepository $anneeScolaireRepository): Response
    {
        $etudiant = new Etudiant();
        $inscription = new Inscription();
        $annee = $anneeScolaireRepository->findOneBy(['etat' => 'true']);
        $etudiant->setRoles(["ROLE_ETUDIANT"]);
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            //ajout etudiant et user
            $etudiant = $form->getData();
            $manager ->persist($etudiant);
            $manager->flush();

            //ajout inscription aussi
            $inscription ->setEtudiant($etudiant);
            $inscription ->setClasse($etudiant -> getClasse());
            $inscription ->setAnneeScolaire($annee);
            $manager ->persist($inscription);
            $manager->flush();
           
            $this ->addFlash(
                "success",
                 "inscription ajout dans les deux effectuer avec succes");
                 return $this->redirectToRoute("app_security_login");
        }
        return $this->render('etudiant/add.html.twig',[
            'form'=> $form->createView(),
               "classes" => $classe->findAll()
        ]);
    }
}
