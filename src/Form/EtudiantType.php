<?php

namespace App\Form;

use App\Entity\Etudiant;
use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EtudiantType extends AbstractType
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
            ->add('password',PasswordType::class,[
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
            ->add('matricule', TextType::class, [
                'required'=>false,
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "2",
                ],
                "label" => "Matricule",
                "label_attr" => [
                   "class"=> "form-label mt-4"
                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 25,"min"=> "2"]),
                ]
                ])
            ->add('tuteur', TextType::class, [
                'required'=>false,
                "attr" => [
                    "class" => "form-control",
                    "maxlength" => "25",
                    "minlenght" => "2",
                ],
                "label" => "tuteur",
                "label_attr" => [
                   "class"=> "form-label mt-4"

                ],
                "constraints"=> [
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=> 25,"min"=> "2"]),
                ]
                ])
                ->add('submit', SubmitType::class, [
                    "attr" => [
                        "class" => "btn btn-primary mt-4 " ,
                        "style" => "background-color: rgb(5, 68, 104)"
                    ],
                    "label" => "Ajouter Inscription",
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
