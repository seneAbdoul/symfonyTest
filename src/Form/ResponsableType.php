<?php

namespace App\Form;

use Assert\NotBlank;
use App\Entity\Responsable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints as Assert;

class ResponsableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email',EmailType::class,[
            "attr" => [
                "class" => "form-control",
                "placeholder" => "senecheikh@gmail.com",
                "maxlength" => "180",
                "minlenght" => "2",
            ],
            "label" => "Adresse Mail",
            "label_attr" => [
               "class"=> "form-label mt-4"

            ],
            
            "constraints"=> [
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Length(["max"=> "180","min"=> "2"]),
            ]
        ])
        ->add('plainPassword',PasswordType::class,[
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "************",
                    "maxlength" => "25",
                    "minlenght" => "4",
                ],
                "label" => "password",
                "label_attr" => [
                   "class"=> "form-label mt-4",
                ],
            "constraints"=> [
                new Assert\NotBlank(),
                new Assert\Length(["max"=> 25,"min"=> "4"]),
            ]
        ])
        ->add('nom', TextType::class, [
            'required'=>false,
            "attr" => [
                "class" => "form-control",
                "maxlength" => "25",
                "minlenght" => "2",
            ],
            "label" => "Nom",
            "label_attr" => [
               "class"=> "form-label mt-4"
            ],
            "constraints"=> [
                new Assert\NotBlank(),
                new Assert\Length(["max"=> 25,"min"=> "2"]),
            ]
            ])
        ->add('prenom', TextType::class, [
            'required'=>false,
            "attr" => [
                "class" => "form-control",
                "maxlength" => "25",
                "minlenght" => "2",
            ],
            "label" => "Prenom",
            "label_attr" => [
               "class"=> "form-label mt-4"
            ],
            "constraints"=> [
                new Assert\NotBlank(),
                new Assert\Length(["max"=> 25,"min"=> "1"]),
            ]
            ])
        ->add('acces', TextType::class, [
            'required'=>false,
            "attr" => [
                "class" => "form-control",
                "maxlength" => "25",
                "minlenght" => "2",
            ],
            "label" => "acces",
            "label_attr" => [
               "class"=> "form-label mt-4"

            ],
            "constraints"=> [
                new Assert\NotBlank(),
                new Assert\Length(["max"=> 25,"min"=> "2"]),
            ]
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image Etudiant',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false,
            ])

            ->add('submit', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4 " ,
                    "style" => "background-color: rgb(5, 68, 104)"
                ],
                "label" => "Ajouter Reponsable",
                ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Responsable::class,
        ]);
    }
}
