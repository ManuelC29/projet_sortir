<?php

namespace App\Form;

use App\Entity\Places;
use App\Entity\Trips;
use Doctrine\DBAL\Types\ArrayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'class-css'
                ],
                'label' => 'Nom de la sortie'
            ])
            ->add('date_start', DateTimeType::class, [
                'label' => 'Date et heure de la sortie'
            ])

            ->add('date_closing', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date limite d\'inscription',
            ])

            ->add('max_registration', NumberType::class, [
                    'label' => 'Nombre de places',
                ])
            ->add('duration', NumberType::class, [
                'label' => 'Durée'
            ])
            ->add('description_infos', TextType::class, [
                'label' => 'Description et infos'
                          ])
            ->add('place')

            ->add('organizer')
            ->add('status')
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trips::class,
        ]);
    }
}
