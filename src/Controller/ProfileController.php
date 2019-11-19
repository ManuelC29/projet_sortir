<?php

namespace App\Controller;

use App\Entity\Participants;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


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
}
