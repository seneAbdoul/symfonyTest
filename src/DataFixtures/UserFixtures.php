<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\User;

use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    private Generator $faker;
  
    public function __construct(){
        $this->faker = Factory::create('fr_FR');
        }
  
        public function load(ObjectManager $manager)
        {
            /*
       for ($i = 1; $i <=10; $i++) {
        $user = new User();
        $pos= rand(0,4);
        $user->setNom($this->faker->firstName());
        $user->setPrenom($this->faker->lastName());
        $user->setEmail($this->faker->email());
        $user->setPlainPassword("passer");
       # $user->setRoles([$roles[$pos]]);
        $manager->persist($user);
        $this->addReference("User".$i, $user);
        }
        $manager->flush();
       */
        }
}
