<?php

namespace App\Form;

use App\Entity\DiffuseurVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DiffuseurVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Image (JPG, PNG file)',
                'required' => false,
                'mapped' => false,
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    "placeholder" => "Enter the name of the car diffuser"
                ]
            ])
            ->add('prix', IntegerType::class, [
                'attr' => [
                    "placeholder" => "Enter the price"
                ]
            ])
            ->add('materiaux', TextType::class, [
                'attr' => [
                    "placeholder" => "Enter the material"
                ]
            ])
            ->add('couleur', TextType::class, [
                'attr' => [
                    "placeholder" => "Enter the color"
                ]
            ])
            ->add('dureeDeVie', IntegerType::class, [
                'attr' => [
                    "placeholder" => "Enter the lifespan"
                ]
            ])
            ->add('taille', IntegerType::class, [
                'attr' => [
                    "placeholder" => "Enter the size"
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    "placeholder" => "Enter the description"
                ]
            ])
            ->add('poids', IntegerType::class, [
                'attr' => [
                    "placeholder" => "Enter the weight"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DiffuseurVoiture::class,
        ]);
    }
}