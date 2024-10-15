<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Examen;
use App\Entity\Filiere;
use App\Entity\Module;
use App\Entity\Professeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints as Assert;

class ExamenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "2",
                ],
                "label" => "libelle",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 255,"min"=> "1"]),
                ]
                ])
            ->add('classes', EntityType::class, [
                'class' => Classe::class,
                'label' => 'Les classes',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('modules', EntityType::class, [
                'class' => Module::class,
                'label' => 'Les modules',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('professeurs', EntityType::class, [
                'class' => Professeur::class,
                'label' => 'Les professeurs',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('filieres', EntityType::class, [
                'class' => Filiere::class,
                'label' => 'Les filieres',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('submit', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4 " ,
                    "style" => "background-color: rgb(5, 68, 104);"
                ],
                "label" => "+ Ajouter Examen",
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Examen::class,
        ]);
    }
}
