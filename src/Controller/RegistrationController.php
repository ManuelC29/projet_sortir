<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\RegistrationType;
use App\Form\TripType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;


class RegistrationController extends Controller
{
    /**
     * @Route("registration/{id}", name="registration")
     */
    public function show($id,Security $user, EntityManagerInterface $entityManager)
    {

        //TODO faire l'enreistrement
        //$entityManager->flush();

        return $this->render('welcome/welcome.html.twig');
    }


}