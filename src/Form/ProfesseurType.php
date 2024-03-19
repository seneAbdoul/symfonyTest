<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "2",
                ],
                "label" => "nom",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 25,"min"=> "1"]),
                ]
                ])
            ->add('prenom', TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "2",
                ],
                "label" => "prenom",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 25,"min"=> "1"]),
                ]
                ])
            ->add('grade', TextType::class, [
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "1",
                ],
                "label" => "grade",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 25,"min"=> "1"]),
                ]
                ])
                ->add('submit', SubmitType::class, [
                    "attr" => [
                        "class" => "btn btn-primary mt-4 " ,
                        "style" => "background-color: rgb(5, 68, 104);margin-left:35%"
                    ],
                    "label" => "Ajouter Professeur",
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
