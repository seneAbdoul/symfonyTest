<?php

namespace App\Form;

use App\Entity\Seance;
use App\Entity\ClassePlanification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', null, [
            'label' => 'Date :', 
            'widget' => 'single_text',
            'attr' => ['class' => 'form-control'], 
        ])
        ->add('heure_debut', null, [
            'label' => 'Heure de début :', 
            'widget' => 'single_text',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('heure_fin', null, [
            'label' => 'Heure de fin :', 
            'widget' => 'single_text',
            'attr' => ['class' => 'form-control'], 
        ])
        ->add('submit', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4 " ,
                    "style" => "background-color: rgb(5, 68, 104)"
                ],
                "label" => "Enregistrer",
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
