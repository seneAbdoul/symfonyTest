<?php

namespace App\Form;

use App\Entity\Filiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints as Assert;


class FiliereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
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
                    new Assert\Length(["max"=> 25,"min"=> "1"]),
                ]
                ])
            ->add('submit', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary mt-4 " ,
                    "style" => "background-color: rgb(5, 68, 104);margin-left:35%"
                ],
                "label" => "Ajouter Filiere",
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filiere::class,
        ]);
    }
}
