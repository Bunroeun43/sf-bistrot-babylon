<?php

namespace App\Form;

use App\Entity\Desserts;
use App\Entity\PlatsCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DessertsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du déssert :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix du dessert :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Desserts::class,
        ]);
    }
}
