<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Absence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AbsenceFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <10 ; $i++) { 
            $cour = $this->getReference('cour'.$i);
            $etudiant = $this->getReference('etudiant'.$i);
          for ($j=0; $j < 10; $j++) { 
              $absence = new Absence();
              $absence->setCour($cour);
              $absence->setEtudiant($etudiant);
              $manager->persist($absence);
              $this->setReference('absence'.$j, $absence);
          }
      };

        $manager->flush();
    }
    public function getDependencies()
    {
    return array(  
      CourFixtures::class,
      EtudiantFixtures::class
    );
    }
}
