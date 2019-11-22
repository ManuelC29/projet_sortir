<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Sites;
use App\Entity\Trips;
use App\Repository\RegistrationsRepository;
use App\Repository\TripsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function index(RegistrationsRepository $registrationsRepository, TripsRepository $tripsRepository, Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage,Security $security)
    {

        $participant = $security->getUser();


        // si un participant est loggé
        if($participant !== null ){

            $registrations = $registrationsRepository->findAll();

            //TODO AJout de filtres
            if ($request->request->get('site') !== null){
                //['place' => .... ]
                $trips = $tripsRepository->findByCity($request->request->get('site'));
            }
            if ($request->request->get('search') !== null){
                
            }
            else{
                //all trips recupération
                //todo EN COURS (manu) si on a pas de sélection activé
                $trips = $entityManager->getRepository(Trips::class)->findAll();
            }



            $sites = $entityManager->getRepository(Sites::class)->findAll();
        }

        return $this->render('welcome/welcome.html.twig', compact('participant','sites','trips','registrations'));
    }


}
