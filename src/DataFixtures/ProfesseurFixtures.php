<?php

namespace App\DataFixtures;
use App\Entity\Professeur; 
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfesseurFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 3 ; $i++){
                $module = $this->getReference("module".$i);
                for ($j= 0; $j < 3; $j++){
                    $professeur = new Professeur();
                    $professeur->setGrade($this->faker->word());
                    $professeur->setCni($this->faker->numerify('#########'));
                    $professeur->setNom($this->faker->lastName());
                    $professeur->setPrenom($this->faker->firstName());
                    $professeur->setEmail($this->faker->email());
                   // $professeur->setModule($module);
                    $professeur->setPlainPassword("passer");
                    $professeur->setRoles(["ROLE_PROFESSEUR"]);
                    $manager->persist($professeur);
                    $this->setReference('professeur'.$j, $professeur);
                }
        }
        $manager->flush();
    }
        public function getDependencies()
        {
        return array(
        ModuleFixtures::class,
         );
        }
}
