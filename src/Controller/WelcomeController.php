<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Sites;
use App\Entity\Trips;
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
    public function index(TripsRepository $tripsRepository, Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage,Security $security)
    {

        $participant = $security->getUser();



        // si un participant est loggé
        dump($request->request->get('site'));
        if($participant !== null ){
            //TODO AJout de filtres
            if ($request->request->get('site') !== null){
                //['place' => .... ]
                $trips = $tripsRepository->findByCity($request->request->get('site'));
                dump($trips);
                dump('toto');
            }else{
                //all trips recupération
                //todo EN COURS (manu) si on a pas de sélection activé
                $trips = $entityManager->getRepository(Trips::class)->findAll();
                dump('tata');
            }


            $sites = $entityManager->getRepository(Sites::class)->findAll();
            dump($participant);
        }

        return $this->render('welcome/welcome.html.twig', compact('participant','sites','trips'));
    }


}
