<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        return $this->render('welcome/welcome.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }
}
