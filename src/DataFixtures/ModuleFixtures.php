<?php

namespace App\DataFixtures;
use Faker\Factory;
use Faker\Generator;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModuleFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(){
          $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <4 ; $i++) { 
            $module = new Module();
            $module->setLibelle($this->faker->word());
            $manager->persist($module);
            $this->addReference('module'.$i, $module);
        }
        $manager->flush();
    }
}
