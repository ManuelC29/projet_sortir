<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\TripType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\EncoderInterface;


class ProfileController extends Controller
{
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id,Participants $participants, EntityManagerInterface $entityManager)
    {
        $participant = $entityManager
            ->getRepository(Participants::class)
            ->find($id);

        return $this->render('profile/show.html.twig', compact('participant'));
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function edit(Security $security, EncoderInterface $encoder, EntityManagerInterface $entityManager, Request $request)
    {
        // TODO A REFAIRE
        /* $participant = $security->getUser();

        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($participant, $participant->getPassword());
            $participant->setPassword($password);
            $entityManager->persist($participant);
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte est créé');
        }
        */

        return $this->render('profile/edit.html.twig', compact('participant'));
    }
}
