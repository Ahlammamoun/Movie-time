<?php

namespace App\Form;

use App\Entity\Casting;
use App\Entity\Actor;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CastingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role')
            ->add('creditOrder')
            ->add('movie',EntityType::class,
                [
                'class' => Movie::class,
                'choice_label' => 'getNameAndDuration',
                ]
            )
            ->add('actor',EntityType::class,
                [
                'class' => Actor::class,
                'choice_label' => 'getFullName'   
                ]
            );
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Casting::class,
        ]);
    }
}
