<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Pen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                null,
                [
                    'label' => "Nom",
                    "required" => true,
                    'attr' => [
                        "placeholder" => "Veuillez renseigner votre nom"
                    ]
                ])
            ->add(
                'birthdate',
                null
            )
            ->add('specie')
            ->add('placeOfBirth')
            ->add('serial')
            ->add(
                'pen',
                EntityType::class,
                [
                    'class' => Pen::class,
                    'choice_label' => 'name',
                    'label' => 'Enclos',
                    'multiple' => false,
                    'required' => false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
