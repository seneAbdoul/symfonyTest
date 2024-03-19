<?php

namespace App\DataFixtures;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Niveau;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NiveauFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10 ; $i++) { 
            $niveau = new Niveau();
            $niveau->setLibelle($this->faker->word());
            $manager->persist($niveau);
            $this->addReference('niveau'.$i, $niveau);
        }
        $manager->flush();
    }
}
