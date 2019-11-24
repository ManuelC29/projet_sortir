<?php

namespace App\Controller;


namespace App\Controller;

use App\Entity\Participants;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function log(Request $request, AuthenticationUtils $authenticationUtils,Security $security)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $participant = $security->getUser();


        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'last_username' => $lastUsername,
            'error' => $error,
            'participant' => $participant
        ]);
    }

    /**
     * @Route("/logout",name="logout")
     */
    public function logout()
    {
        return $this->render('welcome/welcome.html.twig');
    }




    /**
     * @Route("/registration", name="registration")
     */
    public function registration(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $entityManager
    ) {
        $participant = new Participants();
        $form = $this->createForm(RegistrationType::class, $participant);

        // hydratation du participant avec les données saisies sur le formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($participant, $participant->getPassword());
            $participant->setPassword($password);
            $entityManager->persist($participant);
            $entityManager->flush();
            // possibilité d'ajouter un token pour conserver la connexion
            /*
                          $token = new UsernamePasswordToken(
                          $participant,
                          $password,
                          'main',
                          $participant->getRoles()
                        );
                        $tokenStorage->setToken($token);
                        $request->getSession()->set('_security_main', serialize($token));
            */

            $this->addFlash('success', 'Votre compte est créé');
            return $this->redirectToRoute('welcome');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }






}

