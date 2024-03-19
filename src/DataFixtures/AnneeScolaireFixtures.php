<?php

namespace App\DataFixtures;
use App\Entity\AnneeScolaire;
use Faker\Factory;
use Faker\Generator;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnneeScolaireFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10 ; $i++) { 
            $anneeScolaire = new AnneeScolaire();
            $first = $this->faker->numberBetween(2000, 2025) ;
            $annee= $first."-".($first+1);
            $anneeScolaire->setLibelle($annee)
                          ->setEtat('false');            
            $manager->persist($anneeScolaire);
            $this->addReference('anneeScolaire'.$i, $anneeScolaire);
        }
        $manager->flush();
    }
}
