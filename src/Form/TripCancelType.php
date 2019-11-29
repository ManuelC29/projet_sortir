<?php

namespace App\Form;

use App\Entity\Participants;
use App\Entity\Places;
use App\Entity\Trips;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripCancelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'class-css'],'label' => 'Nom de la sortie :'])
            ->add('date_start', DateTimeType::class, [
                'label' => 'Date et heure de la sortie :'])
            ->add('organizer', null, ['label' => 'Organisateur :'])
            ->add('place', null, ['label' => 'Lieu :'])
            ->add('cancelReason', TextType::class, [
                'label' => 'Motif de l\'annulation :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trips::class,
        ]);
    }
}





