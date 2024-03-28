<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use App\Entity\Planification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PlanificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre_heure', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotNull(),
                  
                ]
            ]
             )
            ->add('semestre', TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "2",
                ],
                "label" => "semestre",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 25,"min"=> "1"]),
                ]
                ])
            ->add('module', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'libelle',
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "modules",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
            ])
            ->add('professeur', EntityType::class, [
                'class' => Professeur::class,
                'choice_label' => 'nom',
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "professeurs",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
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
            ->add('cour', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'libelle',
                "attr" => [
                    "class" => "form-control",
                ],
                "label" => "cours",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
            ])
            ->add('submit', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4 " ,
                    "style" => "background-color: rgb(5, 68, 104)"
                ],
                "label" => "Ajouter Planification",
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planification::class,
        ]);
    }
}
