<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Niveau;

use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
      
       // $manager->flush();
    }
}
