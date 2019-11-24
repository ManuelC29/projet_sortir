<?php

namespace App\Form;

use App\Entity\Trips;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripCancelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('date_start')
            ->add('duration')
            ->add('date_closing')
            ->add('max_registration')
            ->add('description_infos')
            ->add('cancelReason')
            ->add('status')
            ->add('place')
            ->add('organizer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trips::class,
        ]);
    }
}
