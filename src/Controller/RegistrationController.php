<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Registrations;
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
     * @Route("registration/add/{id}", name="registrationAdd")
     */
    public function show(Security $user, EntityManagerInterface $entityManager)
    {
        //TODO conditionnel
        $registration = new Registrations();
        dump($user);
        // set l'id de l'user
        //$registration->setParticipant($user);

        //$entityManager->persist($registration);
        //$entityManager->flush();

        //récupérer site trip et registration


        //$entityManager->flush();



        $this->redirectToRoute('welcome');

        return $this->render('welcome/welcome.html.twig');
    }


}