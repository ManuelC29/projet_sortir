<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ParticipantsAdmin extends AbstractAdmin
{


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('nickname', TextType::class)
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('mail')
            ->add('urlPhoto', TextType::class)
            ->add('site')
            ->add('administrator')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nickname')
            ->add('firstname')
            ->add('lastname')
            ->add('mail')
            ->add('site')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('nickname')
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('mail')
            ->add('site')
            ->add('active')
            ->add('administrator')
            ->add('id')
        ;
    }
}