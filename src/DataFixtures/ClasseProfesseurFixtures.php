<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\ClasseProfesseur;
use App\Entity\Professeur;
use App\Repository\ProfesseurRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseProfesseurFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
       for ($i=0; $i < 10; $i++) {
        $classeProfesseur = new ClasseProfesseur();
        $anneeScolaire = $this->getReference('anneeScolaire'.$i);
        $classeProfesseur->setAnneeScolaire($anneeScolaire);
        for ($l=0; $l <mt_rand(1,3) ; $l++) { 
            $professeur = $this->getReference('professeur'.$l);
            $classeProfesseur->setProfesseur($professeur);
        }
        for ($k=0 ;$k < mt_rand(1,6) ; $k++){
            $classe = $this->getReference('classe'.$k); 
            $classeProfesseur->setClasse($classe);
         }
            $manager ->persist($classeProfesseur);
        }
            $manager->flush();
    }
    
    public function getDependencies()
    {
    return array(
      ProfesseurFixtures::class,
     );
    }
}
