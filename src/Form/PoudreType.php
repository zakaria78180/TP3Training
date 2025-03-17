<?php

namespace App\Form;

use App\Entity\Poudre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PoudreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // champ de type FileType pour permettre le téléchargement de fichiers
            ->add('image', FileType::class, [
                'label' => 'Image (JPG, PNG file)',
                'required' => false,
                'mapped' => false, 
            ])
            ->add('nom', TextType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le nom de la poudre parfumée"
                ]
            ])
            ->add('prix', IntegerType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le prix"
                ]
            ])
            ->add('materiaux', TextType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le materiaux"
                ]
            ])
            ->add('couleur', TextType::class,[
                'attr'=>[
                    "placeholder"=>"saisier la couleur"
                ]
            ])
            ->add('dureeDeVie', IntegerType::class,[
                'attr'=>[
                    "placeholder"=>"saisier la durée de vie"
                ]
            ])
            ->add('taille', IntegerType::class,[
                'attr'=>[
                    "placeholder"=>"saisier la taille"
                ]
            ])
            ->add('description', TextareaType::class,[
                'attr'=>[
                    "placeholder"=>"saisier la déscription"
                ]
            ])
            ->add('poids', IntegerType::class,[
                'attr'=>[
                    "placeholder"=>"saisier le poids"
                ]
            ]);
            // ->add('valdier', SubmitType::class);
 
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Poudre::class,
        ]);
    }
}
