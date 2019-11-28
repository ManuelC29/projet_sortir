<?php

namespace App\Controller;

use App\Entity\Places;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ApiController extends Controller
{
    /**
     * @Route("street/{id}", name="street")
     */
    public function street($id, EntityManagerInterface $entityManager, SerializerInterface $serializer){

        $street = $entityManager->getRepository(Places::class)->find($id);

        return new JsonResponse($serializer->serialize($street, 'json'));
    }


    /**
     * @Route("api/{id}", name="api")
     */
    public function show($id, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {

        $places = $entityManager->getRepository(Places::class)->findByCity($id);

        return new JsonResponse($serializer->serialize($places, 'json'));
    }



}