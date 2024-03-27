<?php

namespace App\DataFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;

use App\Entity\Classe;
use App\Entity\Professeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
      
        for ($i=0; $i <4 ; $i++) { 
              $filiere = $this->getReference('filiere'.$i);
              $niveau = $this->getReference('niveau'.$i);
              $cour = $this->getReference('cour'.$i);

            for ($j=0; $j < 5; $j++) { 
                $classe = new Classe();
                $classe->setLibelle($this->faker->word());
                $classe->setFiliere($filiere);
                $classe->setNiveau($niveau);
                //$classe->setCour($cour);
                $manager->persist($classe);
                $this->setReference('classe'.$j, $classe);
            }
        };

        $manager->flush();
    }
    public function getDependencies()
            {
            return array(
            CourFixtures::class,
            NiveauFixtures::class,
            FiliereFixtures::class
            );
            }
}
