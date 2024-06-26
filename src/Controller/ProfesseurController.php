<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ProfType;
use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Service\SmsGenerate;
use App\Entity\ClasseProfesseur;
use App\Repository\ClasseRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur/add', name: 'app_professeur_add',methods: ['GET',"POST"])]
    public function index(Request  $request,
    EntityManagerInterface $manager,
    ClasseRepository $classeRepository,
    AnneeScolaireRepository $anneeScolaireRepository,
    SmsGenerate $genarator): Response
    {
        $professeur = new Professeur();
        $classeProfesseur = new ClasseProfesseur();

        $annee = $anneeScolaireRepository->findOneBy(['etat' => 'true']);
        $professeur->setRoles(["ROLE_PROFESSEUR"]);
        $classeId = $request->request->get('classe');
        $classe = $classeRepository->findOneBy(['id'=> $classeId]);
        $professeur->setCni($genarator->generateTruc());

        $form = $this->createForm(ProfType::class, $professeur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
                $professeur = $form ->getData();
                $manager ->persist($professeur);
                $manager ->flush();
              
               $classeProfesseur ->setProfesseur($professeur);
               $classeProfesseur->setAnneeScolaire($annee);
               $classeProfesseur->setClasse($classe);
               $manager ->persist($classeProfesseur);
               $manager ->flush();
            $this ->addFlash(
                "success",
                 "professeur ajouter avec succes");
                 return $this->redirectToRoute("app_professeur_liste");
        }
        return $this->render('professeur/add.html.twig',[
            "form" => $form->createView(),
            "classes" => $classeRepository->findAll()
        ]);
    }

    #[Route('/professeur/liste', name: 'app_professeur_liste',methods: ['GET'])]
    public function index1(ProfesseurRepository $professeurRepository,
     PaginatorInterface $paginator,Request $request): Response
    {
        $professeurs = $paginator->paginate(
            $professeurRepository->findAll(), 
            $request->query->getInt('page', 1), 
            5 
        );
        return $this->render('professeur/liste.html.twig', [
            'professeurs'=> $professeurs
        ]);
    }
    #[Route('/professeur/cour', name: 'app_professeur_cour',methods: ['GET'])]
    public function cour(Request $request,PaginatorInterface $paginator){
        $professeur = $this ->getUser();
        if($professeur instanceof Professeur){
            $planifications = $professeur ->getPlanifications()->toArray();
        }
        $classes = [];
        if ($planifications) {
            foreach ($planifications as $value) {
                  $classess[] = $value ->getClasses()->toArray();
            }
        }
       // dd($classes);
        $classes = $paginator->paginate(
            $classess, 
            $request->query->getInt('page', 1), 
            5 
        );
        return $this->render('professeur/cour.html.twig',[
            'professeur'=> $professeur,
            'planifications' => $planifications, 
            'classes' => $classes  
        ]);
    }
     #[Route('/professeur/listeSeance', name: 'app_professeur_listeSeance',methods: ['GET'])]
        public function listeSeance(PaginatorInterface $paginator,Request $request){
            $professeur = $this ->getUser();
            if($professeur instanceof Professeur){
                $planifications = $professeur -> getPlanifications()->toArray();
            }
          
            if($planifications){
                  $profPlanifications = [];
                  foreach ($planifications as $value) { 
                    $profPlanifications[] = $value ->getClassePlanifications()->toArray();
                  }
            }
            $profPlanificationss = [];
            foreach ($profPlanifications as $value) {
                foreach ($value as $value1) {
                    $profPlanificationss[] = $value;
                } 
            }
            $seancess = [];
            foreach ($profPlanificationss as $value) {
                foreach ($value as  $value1) {
                    $seancess[] = $value1 ->getSeances()->toArray();
                }  
            }
            $seancesss = [];
            foreach ($seancess as $value) {
                foreach ($value as $value1) {
                    $seancesss[] = $value1;
                }    
            }
            $seances = $paginator->paginate(
                $seancesss, 
                $request->query->getInt('page', 1), 
                5
            );
            return $this->render('professeur/listeSeance.html.twig',[
                'seances' => $seances,
                'professeur'=> $professeur,
            ]);
        }


}
