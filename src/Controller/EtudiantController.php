<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Service\SmsGenerate;
use App\Entity\AnneeScolaire;
use App\Repository\AbsenceRepository;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiantInscrit/liste', name: 'app_etudiant_Inscritliste', methods: ['GET'])]
    public function liste(InscriptionRepository $inscriptionRepository,
    Request $request,
    PaginatorInterface $paginator,ClasseRepository $classe,AbsenceRepository $absenceRepository): Response
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
    public function add(
        EntityManagerInterface $manager,
        Request $request,
        ClasseRepository $classe,
        AnneeScolaireRepository $anneeScolaireRepository,
        SmsGenerate $genarator): Response
    {
        $etudiant = new Etudiant();
        $inscription = new Inscription();
        $annee = $anneeScolaireRepository->findOneBy(['etat' => 'true']);
        $etudiant->setRoles(["ROLE_ETUDIANT"]);
        $etudiant->setMatricule($genarator->generateTruc());
        $classeId = $request->request->get('classe');
        $classeInscription = $classe->findOneBy(['id'=> $classeId]);

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //ajout etudiant etudiant
            $etudiant = $form->getData();
            $manager ->persist($etudiant);
            $manager->flush();

            //ajout inscription aussi
            $inscription ->setEtudiant($etudiant);
            $inscription ->setClasse($classeInscription);
            $inscription ->setAnneeScolaire($annee);
            $manager ->persist($inscription);
            $manager->flush();
           
            $this ->addFlash(
                "success",
                 "inscription ajout dans les deux effectuer avec succes");
                 return $this->redirectToRoute("app_etudiant_Inscritliste");
        }
        return $this->render('etudiant/add.html.twig',[
            'form'=> $form->createView(),
            "classes" => $classe->findAll()
        ]);
    }

    #[Route('/etudiant/absence', name: 'app_etudiant_absence', methods: ['GET','POST'])]
    public function absence(PaginatorInterface $paginator,Request $request){
        $etudiant = $this->getUser();
        if ($etudiant instanceof Etudiant) {
            $absencess = $etudiant->getAbsences()->toArray();
        }
        $absences = $paginator ->paginate(
            $absencess,
            $request->query->getInt('page',1),
            5,
        );
       return $this->render('etudiant/absence.html.twig',[
               'absences'=> $absences
       ]);
    }

    #[Route('/etudiant/cour', name: 'app_etudiant_cour', methods: ['GET','POST'])]
    public function cour(PaginatorInterface $paginator,Request $request){

       return $this->render('etudiant/cours.html.twig');
    }
}
