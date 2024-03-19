<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Filiere; 
use Faker\Factory;
use Faker\Generator;

class FiliereFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
      
        for ($i=0; $i <10 ; $i++) { 
            $filiere = new Filiere();
            $filiere->setLibelle($this->faker->word());
            $manager->persist($filiere);
            $this->addReference('filiere'.$i, $filiere);
        };

        $manager->flush();
    }
}
