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
     * @Route("api/{id}", name="api")
     */
    public function show($id, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $places = $entityManager->getRepository(Places::class)->find($id);

        return new JsonResponse($serializer->serialize($places, 'json'));
    }

}