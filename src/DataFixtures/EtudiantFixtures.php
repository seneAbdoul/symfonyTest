<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;

use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class EtudiantFixtures extends Fixture 

{ 
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <=5; $i++) {
            $etudiant = new Etudiant();
            $etudiant->setMatricule($this->faker->word());
            $etudiant->setTuteur($this->faker->firstName()." ".$this->faker->lastName());
            $etudiant->setNom($this->faker->lastName());
            $etudiant->setPrenom($this->faker->firstName());
            $etudiant->setEmail($this->faker->email());
            $etudiant->setPlainPassword("passer");
            $etudiant->setRoles(["ROLE_ETUDIANT"]);
            $manager->persist($etudiant);
            $this->addReference("etudiant".$i, $etudiant);
            }
         $manager->flush();
    }
    
}
