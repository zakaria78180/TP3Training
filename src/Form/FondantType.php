<?php

namespace App\Form;

use App\Entity\Fondant;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FondantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('image', FileType::class, [
            'label' => 'Image (JPG, PNG file)',
            'required' => false,
            'mapped' => false, // This ensures the file is not mapped to the entity property
        ])
            ->add('nom', TextType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le nom du fondant"
                ]
            ])
            ->add('prix', NumberType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le prix"
                ]
            ])
            ->add('materiaux', TextType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le materiaux"
                ]
            ])
            ->add('ddv', IntegerType::class,[
                'attr'=>[
                    "placeholder"=>"saisier la durée de vie"
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fondant::class,
        ]);
    }
}
