<?php

namespace App\Controller;

use App\Entity\Trips;
use App\Form\TripType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class TripController extends Controller
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/trip", name="trip")
     */
    public function index()
    {
        return $this->render('trip/index.html.twig', [
            'controller_name' => 'TripController',
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request, Security $security)
    {
        $participant = $security->getUser();
        $trip = new Trips();
        $form = $this->createForm(TripType::class, $trip);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($trip);
            $this->entityManager->flush();

            $this->addFlash('success', 'Votre sortie est ajoutée !');
            return $this->redirectToRoute('welcome', compact('participant'));
        }

        return $this->render('trip/add.html.twig',[
            'form' => $form->createView(),
            'participant' => $participant
        ]);
    }

    /**
     * @Route("/show/{id}",name="show")
     */
    public function show(Trips $trip, Security $security)
    {
        $participant = $security->getUser();
        return $this->render('trip/show.html.twig', compact('trip', 'participant'));
    }




}
