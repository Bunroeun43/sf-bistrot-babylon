<?php

namespace App\Form;

use App\Entity\Plats;
use App\Entity\Entrees;
use App\Entity\Desserts;
use App\Entity\Formules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FormulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la formule :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description de la formule :',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('photo', FileType::class, [
                'label' => 'Votre image de profil :',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '16384k',
                        'maxSizeMessage' => 'Taille de fichier trop grande',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg',
                            'image/jpg',
                            'image/webp',
                            'image/bmp',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Extension de fichier invalide',
                    ])
                    ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'data_class' => null,
            ])
            ->add('entrees', EntityType::class, [
                'class' => Entrees::class,
                'label' => 'Sélectionner les entrées :',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('plats', EntityType::class, [
                'class' => Plats::class,
                'label' => 'Sélectionner les plats :',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('desserts', EntityType::class, [
                'class' => Desserts::class,
                'label' => 'Sélectionner les désserts :',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('isActive')
            ->add('prix', NumberType::class, [
                'label' => 'Prix :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formules::class,
        ]);
    }
}
