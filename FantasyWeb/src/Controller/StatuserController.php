<?php

namespace App\Controller;

use App\Entity\Statistique;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatuserController extends AbstractController
{
    /**
     * @Route("/statuser", name="statuser")
     */
    public function index(): Response
    {
         $statistiques = $this->getDoctrine()
        ->getRepository(Statistique::class)
        ->findAll();
        return $this->render('user_actualite/statistique.html.twig', [
            'statistiques' => $statistiques,
        ]);
    }
}
