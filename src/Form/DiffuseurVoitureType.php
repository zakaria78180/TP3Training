<?php

namespace App\Form;

use App\Entity\DiffuseurVoiture;
use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiffuseurVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du diffuseur',
                'attr' => [
                    'placeholder' => 'Entrez le nom du diffuseur',
                    'class' => 'form-control'
                ]
            ])
            ->add('materiaux', TextType::class, [
                'label' => 'Matériaux',
                'attr' => [
                    'placeholder' => 'Entrez les matériaux',
                    'class' => 'form-control'
                ]
            ])
            ->add('prix', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'EUR',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('couleur', TextType::class, [
                'label' => 'Couleur',
                'attr' => [
                    'placeholder' => 'Entrez la couleur',
                    'class' => 'form-control'
                ]
            ])
            ->add('poids', NumberType::class, [
                'label' => 'Poids (g)',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dureeDeVie', NumberType::class, [
                'label' => 'Durée de vie (jours)',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('taille', NumberType::class, [
                'label' => 'Taille (cm)',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Entrez une description',
                    'class' => 'form-control',
                    'rows' => 4
                ]
            ])
            ->add('image', UrlType::class, [
                'label' => 'Image (URL)',
                'attr' => [
                    'placeholder' => 'URL de l\'image',
                    'class' => 'form-control'
                ]
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'label' => 'Marque',
                'placeholder' => 'Sélectionnez une marque',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DiffuseurVoiture::class,
        ]);
    }
}

