<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CourFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    { 
          for ($j=0; $j < 4; $j++) { 
              $cour = new Cours();
              $cour->setLibelle($this ->faker->word());
              $manager->persist($cour);
              $this->setReference('cour'.$j, $cour);
          }
        $manager->flush();
    }

    public function getDependencies()
    {
    return array(  
      ProfesseurFixtures::class
    );
    }
}
