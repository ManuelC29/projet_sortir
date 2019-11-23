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


class ProfileController extends Controller
{
    /**
     * @Route("profile/show/{id}", name="profileShow")
     */
    public function show($id,Participants $participant, EntityManagerInterface $entityManager)
    {
        //$participant = $entityManager->getRepository(Participants::class)->find($id);

        return $this->render('profile/show.html.twig',['participant' => $participant]);
    }

    /**
     * @Route("profile/modify", name="profileModify")
     */
    public function edit(Security $user, UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager, Request $request)
    {
        // TODO A REFAIRE
        $participant = $user->getUser();
        $form = $this->createForm(RegistrationType::class, $participant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($participant, $participant->getPassword());
            $participant->setPassword($password);

            $entityManager->flush();


            $this->addFlash('success', 'Votre compte a bien été modifié');

            return $this->redirectToRoute('welcome');
        }

        return $this->render('profile/modify.html.twig', [
            'form'=>$form->createView()
        ]);
    }



}
