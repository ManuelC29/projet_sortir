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
        if($participant !== null ){

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

                //TODO OK (Manu)
                /* On peut s'inscrire seuleument si ... #}
                   X condition 1 : le statut du trip doit être publié == Ouverte
                   X condition 2 : le nombre de place ne doit pas être atteint == maxRegistration
                   X condition 3 : la date limite d’inscription ne soit pas dépassée
                   X condition 4 : l'heure de la sortie n'est pas dépassée
                   X condition 5 : on est pas déjà inscrit */

                $user = $entityManager->getRepository(Participants::class)->find($this->getUser());
                $sortie = $entityManager->getRepository(Trips::class)->find($request->get('inscription'));
                $regis = $entityManager->getRepository(Registrations::class)->findByIdTrip($request->get('inscription'));

                // Création d'un objet registration
                $registration = new Registrations();
                // set l'id de l'user
                $registration->setParticipant($entityManager->getRepository(Participants::class)->find($this->getUser()));

                    // la date limite d’inscription ne soit pas dépassée
                if($sortie->getDateStart()<new \DateTime()) {
                    $this->addFlash('danger', 'La date limite d\'inscription est dépassée');
                    $this->redirectToRoute("welcome");

                    //test si on est pas déjà inscrit [OK]
                }elseif($entityManager->getRepository(Registrations::class)->findOneByPartIdAndTripsId($user->getId(),$request->get('inscription'))){
                    $this->addFlash('danger', 'Vous êtes déjà inscrit à la sortie');
                    $this->redirectToRoute("welcome");

                    // Si la sortie n'a pas l'état Ouvert [OK]
                }elseif ($entityManager->getRepository(Trips::class)->find($request->get('inscription'))->getStatus()->getId() != 2) {
                    $this->addFlash('danger', 'Le statut de la sortie n\'est pas Ouvert');
                    $this->redirectToRoute("welcome");

                    //Si le nombre d'enregistration n'est pas atteint [OK]
                }elseif(count($regis) >= $sortie->getMaxRegistration()) {
                    $this->addFlash('danger', 'Il n\'y à plus de place dans cette Sortie');
                    $this->redirectToRoute("welcome");
                }else{
                    // set l'id de la sortie
                    $sortie = $entityManager->getRepository(Trips::class)->find($request->get('inscription'));
                    $registration->setTrips($sortie);
                    // set la date d'inscription a ce trip
                    $registration->setDateRegistration(new \DateTime());
                    // je persist et je flush en BDD
                    $entityManager->persist($registration);
                    $entityManager->flush();
                    $this->addFlash('success', 'Vous avez bien été enregistré sur la sortie ' . $sortie->getName());
                }
            }

            //si on a cliqué sur se désister
            //TODO changer la $request
            if ($request->get('desist') != null) {

                //TODO Condition si jamais je suis pas senregistré sur le trip en cours

                $registration = new Registrations();
                // récupération de l'utilisateur
                $userEnCours = $entityManager->getRepository(Participants::class)->find($this->getUser());

                // récupérer la registration
                $trip = $entityManager->getRepository(Trips::class)->find($request->get('desist'));

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

            }

            $regiTrip = $request->request->get('regiTrip');
            $noreTrip = $request->request->get('noreTrip');
            $user = $entityManager->getRepository(Participants::class)->find($this->getUser()->getID());
            $trips = $tripsRepository->findByFilters($user, $idSites, $search, $debut, $fin, $orgaTrip, $regiTrip, $noreTrip, $oldsTrip);
        }

        $registrations = $registrationsRepository->findAll();
        $sites = $entityManager->getRepository(Sites::class)->findAll();


        return $this->render('welcome/welcome.html.twig', compact('participant', 'sites', 'trips', 'registrations'));
    }


}
