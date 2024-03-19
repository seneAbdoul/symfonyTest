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
        for ($i=0; $i < 10 ; $i++){
            $professeur = new Professeur();
            $professeur->setNom($this->faker->lastName())
                       ->setPrenom($this->faker->firstName())
                       ->setGrade($this->faker->word());
            $manager->persist($professeur);
            $this->addReference('professeur'.$i, $professeur);
        }

        $manager->flush();
    }
        public function getDependencies()
        {
        return array(
        ClasseFixtures::class,
        );
        }
}
