<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Absence;
use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AbsenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('etudiant', EntityType::class, [
            'class' => Etudiant::class,
            'label' => 'Les etudiants',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4',
                'style' => 'background-color: rgb(5, 68, 104)'
            ],
            'label' => 'Ajouter Absence'
        ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Absence::class,
        ]);
    }
}
