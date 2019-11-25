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
            // UserLoginType::class, [ 'attr' => ['class' => 'class-css'],'label' => 'Pseudo']
            ->add('nickname', TextType::class,  ['label' => 'Pseudo', 'empty_data' => 'Votre Pseudo'] )
            ->add('lastname', TextType::class, ['label' => 'Nom', 'empty_data' => 'Votre nom'])
            ->add('firstname', TextType::class, ['label' => 'Prénom', 'empty_data' => 'Votre prenom'])
            ->add('mail', EmailType::class, ['label' => 'E-mail'])
            ->add('phone', TelType::class, ['label' => 'Numéro de téléphone', 'empty_data' => 'Votre téléphone'])
            ->add('password', PasswordType::class, ['label' => 'Password'])
            ->add('confirmPassword', PasswordType::class, ['label' => 'Confirmation Password'])
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
