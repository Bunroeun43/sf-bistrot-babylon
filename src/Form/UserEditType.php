<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Indiquez votre adresse e-mail :',
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
            ->add('nom', TextType::class, [
                'label' => 'Indiquez votre nom :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Indiquez votre prénom :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('naissance', DateType::class, [
                'label' => 'Indiquez votre date de naissance :',
                'format' => 'dd / MM / yyyy',
                'widget' => 'choice',
                'years' => range(date('Y')-90,date('Y')-18)
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Choisissez un genre :',
                'choices' => [
                    'homme' => "homme",
                    'femme' => "femme",
                    'bisexuel' => "bisexuel",
                    'trans' => 'trans',
                    'pansexuel' => 'pansexuel'
                ],
                'choice_attr' => [
                    'homme' => ['class' => 'me-1'],
                    'femme' => ['class' => 'ms-3 me-1'],
                    'bisexuel' => ['class' => 'ms-3 me-1'],
                    'trans' => ['class' => 'ms-3 me-1'],
                    'pansexuel' => ['class' => 'ms-3 me-1'],
                ],
                'multiple' => false,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Choisissez un ou plusieurs rôles :',
                'choices' => [
                    'Administrateur' => "ROLE_ADMIN",
                    'Employé' => "ROLE_MOD",
                    'Client' => "ROLE_USER",
                ],
                'choice_attr' => [
                    'Administrateur' => ['class' => 'me-1'],
                    'Rédacteur' => ['class' => 'ms-3 me-1'],
                    'Auteur' => ['class' => 'ms-3 me-1'],
                ],
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Indiquez votre adresse :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('complementadresse', TextareaType::class, [
                'label' => 'Indiquez un complément d\'adresse :',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('codepostal', NumberType::class, [
                'label' => 'Entrez votre code postal :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Indiquez votre ville :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Votre numéro de téléphone :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
