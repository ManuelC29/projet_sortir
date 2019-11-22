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
     * @Route("/trip/add", name="tripAdd")
     */
    public function add(Request $request)
    {
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
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/trip/modify/{id}", name="tripModify", requirements={"id":"\d+"})
     */
    public function modify (Trips $trip, Request $request, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre sortie est modifiée !');
            return $this->redirectToRoute('tripModify', ['id'=> $trip->getId()]);
        }

        return $this->render('trip/modify.html.twig', ['ad' =>$trip,
            'form' => $form->createView()
        ]);


    }


    /**
     * @Route("/trip/show/{id}",name="tripShow")
     */
    public function show(Trips $trip, Security $security)
    {
        // ATTENTION ! ci-dessous récupération du User connecté, et non de l'organisateur
        dump($trip);
        return $this->render('trip/show.html.twig', compact('trip'));
    }




}
