<?php

namespace App\Admin;

use Cassandra\Numeric;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\IntegerType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Sodium\add;

final class TripsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class)
                    ->add('dateStart', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
                    ->add('duration', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
                    ->add('descriptionInfos', TextareaType::class)
                    ->add('dateClosing', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
                    ->add('organizer')
                    ->add('place')
                    ->add('status')
                    ->add('maxRegistration', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
            ->add('duration')
            ->add('organizer')
            ->add('place')
            ->add('status')
           ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
            ->add('dateStart')
            ->add('duration', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
            ->add('descriptionInfos', TextareaType::class)
            ->add('dateClosing')
            ->add('organizer')
            ->add('place')
            ->add('status')
            ->add('maxRegistration', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class);
    }
}