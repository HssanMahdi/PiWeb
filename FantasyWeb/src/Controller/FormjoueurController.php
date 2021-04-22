<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormjoueurController extends AbstractController
{
    /**
     * @Route("/formjoueur", name="formjoueur")
     */
    public function index(FormationRepository $repo): Response
    {   $idu=1;
        $idf=$repo->findFormationByUser($idu)->getIdFormation();
        return $this->render('formjoueur/index.html.twig', [
            'idf' => $idf,
        ]);
    }
}
