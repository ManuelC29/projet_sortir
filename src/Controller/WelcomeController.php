<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Registrations;
use App\Entity\Sites;
use App\Entity\Status;
use App\Entity\Trips;
use App\Repository\ParticipantsRepository;
use App\Repository\RegistrationsRepository;
use App\Repository\StatusRepository;
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
    public function index(RegistrationsRepository $registrationsRepository,
                          StatusRepository $statusRepository,
                          TripsRepository $tripsRepository,
                          ParticipantsRepository $participantsRepository,
                          Request $request,
                          EntityManagerInterface $entityManager,
                          TokenStorageInterface $tokenStorage,
                          Security $security
    )

    {

        $participant = $security->getUser();


        // si un participant est loggé
        if($participant !== null){
            //TODO AJout de filtres

            $idSites = $request->request->get('site');
            $search = $request->request->get('search');
            $debut = $request->request->get('debut');
            $fin = $request->request->get('fin');
            $orgaTrip = $request->request->get('orgaTrip');
            $regiTrip = $request->request->get('regiTrip');
            $noreTrip = $request->request->get('noreTrip');
            $oldsTrip = $request->request->get('oldsTrip');


            $user = $entityManager->getRepository(Participants::class)->find($this->getUser()->getId());
            $trips = $tripsRepository->findByFilters($user, $idSites, $search, $debut, $fin, $orgaTrip, $regiTrip, $noreTrip, $oldsTrip);

            // si on a cliqué sur s'inscrire
            if ($request->get('inscription') != null) {
                //TODO conditionnelle d'inscription à faire

                //TODO Si je suis déjà inscrit passer et afficher un message
                //Liste de participants

                //TODO EN COURS (Manu)
                /* On peut s'inscrire seuleument si ... #}
                    condition 1 : le statut du trip doit être publié == Ouverte
                    condition 2 : le nombre de place ne doit pas être atteint == maxRegistration
                    condition 3 : la date limite d’inscription ne soit pas dépassée
                    condition 4 : l'heure de la sortie n'est pas dépassé
                    condition 5 : on est pas déjà inscrit */


                    $user = $entityManager->getRepository(Participants::class)->find($this->getUser());

                    // Création d'un objet registration
                    $registration = new Registrations();
                    // set l'id de l'user
                    $registration->setParticipant($entityManager->getRepository(Participants::class)->find($this->getUser()));
                    //$isOn = false;

                   // foreach ($registration->getParticipant()){
                     //   if ($user->getId() == $registration->getId() ){
                       //     $isOn = true;
                         //   break;
                        //}
                    //}

                    //dump($registration);
                    // set l'id de la sortie
                    $sortie = $entityManager->getRepository(Trips::class)->find($request->get('inscription'));
                    $registration->setTrips($sortie);
                    // set la date d'inscription a ce trip
                    $registration->setDateRegistration(new \DateTime());

                    //if($entityManager->getRepository(Participants::class->find($this->getUser())) ){
                        //TODO
                    //}
                    $entityManager->persist($registration);
                    $entityManager->flush();
                    $this->addFlash('success', 'Vous avez bien été enregistré sur la sortie ' . $sortie->getName());


            }

            //si on a cliqué sur se désister
            //TODO changer la $request
            if ($request->get('desist') != null) {

                //TODO Condition si jamais je suis pas senregistré sur le trip en cours

                $registration = new Registrations();
                // récupération de l'utilisateur
                $userEnCours = $entityManager->getRepository(Participants::class)->find($this->getUser());
                dump($userEnCours);
                // récupérer la registration
                $trip = $entityManager->getRepository(Trips::class)->find($request->get('desist'));
                dump($trip);

                $registration->setParticipant($userEnCours);
                $registration->setTrips($trip);

                $registration = $entityManager->getRepository(Registrations::class)->findBy(['participant' => $userEnCours->getId(), 'trips' => $trip->getId()]);

                //si il n'y une registration correspondante.
                if (!empty($registration)) {
                    //si on est déjà inscrit


                    //effacer la registration
                    $entityManager->remove($registration[0]);
                    $entityManager->flush();
                    $this->addFlash('danger', 'Vous avez bien été désinscrit de la sortie ');
                } else {
                    //sinon je lui dit qu'il n'ait pas registré
                    $this->addFlash('danger', 'Vous n\'êtes pas inscrit sur cette sortie');
                }

                dump($registration);


            }

            $regiTrip = $request->request->get('regiTrip');
            $noreTrip = $request->request->get('noreTrip');
            $user = $entityManager->getRepository(Participants::class)->find($this->getUser()->getID());
            $trips = $tripsRepository->findByFilters($user, $idSites,$search, $debut, $fin, $orgaTrip, $regiTrip, $noreTrip, $oldsTrip);
        }

        $registrations = $registrationsRepository->findAll();
        $sites = $entityManager->getRepository(Sites::class)->findAll();


        return $this->render('welcome/welcome.html.twig', compact('participant', 'sites', 'trips', 'registrations'));
    }


}
