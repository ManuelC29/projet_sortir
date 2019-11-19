<?php

namespace App\Controller;

use App\Entity\Participants;
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
    public function index(Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage,Security $security)
    {

        $participant = $security->getUser();

       /* if(!empty($_SESSION['participant'])) {
            //$id = $_SESSION['paricipant'];
            $participants = $entityManager
                ->getRepository(Participants::class);
                //->find($id);
        }*/

        return $this->render('welcome/welcome.html.twig', compact('participant'));
    }
}
