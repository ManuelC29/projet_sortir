<?php

namespace App\Controller;


namespace App\Controller;

use App\Entity\Participants;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
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

    /**
     * @Route("/forgottenPassword", name="app_forgotten_password")
     */

        public function forgottenPassword(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response
        {
            if ($request->isMethod('POST')) {

                $email = $request->request->get('email');

                 $entityManager = $this->getDoctrine()->getManager();
                 $user = $entityManager->getRepository(Participants::class)->findOneByEmail($email);

                 if ($user === null) {
                     $this->addFlash('danger', 'Email Inconnu, recommence !');
                    return $this->redirectToRoute('app_forgotten_password');
                 }

                 $token = $tokenGenerator->generateToken();

                 try{
                     $user->setResetToken($token);
                     $entityManager->flush();
                 } catch (\Exception $e) {
                     $this->addFlash('warning', $e->getMessage());
                     return $this->redirectToRoute('welcome');
                 }

                 $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

                 $message = (new \Swift_Message('Oubli de mot de passe - Réinisialisation'))
                     ->setFrom(array('loisss.barre@gmail.com' => 'Loïc Barré'))
                     ->setTo($user->getMail())
                     ->setReplyTo($email)
                     ->setSubject('Mot de passe oublié')
                     ->setBody(
                         $this->renderView(
                             'security/emails/resetPasswordMail.html.twig',
                             [
                                 'user'=>$user,
                                 'url'=>$url
                             ]
                         ),
                         'text/html'
                     );
                 $mailer->send($message);

                 $this->addFlash('primary', 'Mail envoyé, tu vas pouvoir te connecter à nouveau !');

                 return $this->redirectToRoute('app_reset_password');
             }

            return $this->render('security/forgotten_password.html.twig');
        }

        /** Réinisialiation du mot de passe par mail
         * @Route("/reinitialiser-mot-de-passe", name="app_reset_password")
         */
        public function resetPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
        {
            //Reset avec le mail envoyé
            if ($request->isMethod('POST')) {

                $email = $request->request->get('email');

                $entityManager = $this->getDoctrine()->getManager();
                $user = $entityManager->getRepository(Participants::class)->findOneByEmail($email);

                if ($user === null) {
                    $this->addFlash('danger', 'Email Inconnu, recommence !');
                    return $this->redirectToRoute('app_reset_password');
                }

                $confirm = $request->request->get('confirm');

                if ($confirm !== '1349') {
                    $this->addFlash('danger', 'Code de confirmation incorrect');
                    return $this->redirectToRoute('app_reset_password');
                }

                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
                $entityManager->flush();

                $password = $request->request->get('password');
                $confirmpass = $request->request->get('confpass');

                if ($password !== $confirmpass) {
                    $this->addFlash('danger', 'Le mot de passe de confirmation ne correspond pas au mot de passe saisi');
                    return $this->redirectToRoute('app_reset_password');
                };



                $this->addFlash('notice', 'Mot de passe mis à jour !');

                return $this->redirectToRoute('login');
            }else {

                return $this->render('security/emails/resetPasswordMail.html.twig');
            }

        }



}

