<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 5
        ; $i++) { 
             $inscription = new Inscription();
             $classe = $this->getReference("classe".$i);
             $etudiant = $this->getReference("etudiant".$i);
             $anneeScolaire = $this->getReference("anneeScolaire".$i);
             for ($j=0; $j <3 ; $j++) { 
             $inscription->setClasse($classe);
             $inscription->setEtudiant($etudiant);
             $inscription->setAnneeScolaire($anneeScolaire);
             $manager->persist($inscription);
             $this->setReference('inscription'.$j, $inscription);
             }
             
        }

        $manager->flush();
     }
            public function getDependencies()
            {
            return array(
                AnneeScolaireFixtures::class,
                ClasseFixtures::class,
                EtudiantFixtures::class,
            );
            }
}
