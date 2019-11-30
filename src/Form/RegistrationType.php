<?php

namespace App\Form;

use App\Entity\Participants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname', TextType::class,  ['label' => 'Pseudo', 'empty_data' => 'Votre Pseudo', 'attr' => ['placeholder' => 'Pseudo'] ] )
            ->add('lastname', TextType::class, ['label' => 'Nom', 'empty_data' => 'Votre nom', 'attr' => ['placeholder' => 'Nom']])
            ->add('firstname', TextType::class, ['label' => 'Prénom', 'empty_data' => 'Votre prenom', 'attr' => ['placeholder' => 'Prénom']])
            ->add('mail', EmailType::class, ['label' => 'E-mail', 'attr' => ['placeholder' => 'email']])
            ->add('phone', TelType::class, ['label' => 'Numéro de téléphone', 'empty_data' => 'Votre téléphone', 'attr' => ['placeholder' => 'téléphone']])
            ->add('password', PasswordType::class, ['label' => 'Password', 'attr' => ['placeholder' => 'password']])
            ->add('confirmPassword', PasswordType::class, ['label' => 'Confirmation Password', 'attr' => ['placeholder' => 'confirmation password']])
            ->add('url_photo')
            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}


