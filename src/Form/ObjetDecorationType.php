<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ObjetDecoration;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ObjetDecorationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Image (JPG, PNG file)',
                'required' => false,
                'mapped' => false, // This ensures the file is not mapped to the entity property
            ])
            ->add('nom')
            ->add('prix')
            ->add('materiaux')
            ->add('couleur')
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ObjetDecoration::class,
        ]);
    }
}