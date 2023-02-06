<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Pseudo',
                'attr'  => [
                  'placeholder' =>  'saisissez votre pseudo',
                ]
            ])
            //TextEmail plus les use au dessus pour les mails
            //https://symfony.com/doc/current/reference/forms/types.html
            ->add('description', TextType::class, [
                'label' => 'votre commentaire',
             ])
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    'Excellent' => 5,
                    'Trés bon' => 4,
                    'Bon' => 3,
                    'Moyen' => 2,
                    'A éviter' => 1,
                ],
              
                'placeholder' => 'Votre appréciation',
                'preferred_choices' => [3, 1],
                'label' => false,

            ])
            //->add('Movie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
