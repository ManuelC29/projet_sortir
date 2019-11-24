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
            //TODO AJout de filtres
            $idSites = $request->request->get('site');
            $search = $request->request->get('search');
            $debut = $request->request->get('debut');
            $fin = $request->request->get('fin');
            $orgaTrip = $request->request->get('orgaTrip');
            $trips = $tripsRepository->findByFilters($idSites,$search, $debut, $fin, $orgaTrip);

        }
               $registrations = $registrationsRepository->findAll();
        $sites = $entityManager->getRepository(Sites::class)->findAll();


        return $this->render('welcome/welcome.html.twig', compact('participant','sites','trips','registrations'));
    }


}
