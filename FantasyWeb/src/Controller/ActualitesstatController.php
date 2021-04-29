<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesstatController extends AbstractController
{
    /**
     * @Route("/actualitesstat", name="actualitesstat")

     */
    public function stat(ActualiteRepository $ac)
    {
        // On va chercher le nombre d'annonces publiées par date
        $actualites = $ac->countByDate();

        $dates = [];
        $Countactualites = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($actualites as $actualites){
            $dates[] = $actualites['dateActualites'];
            $Countactualites[] = $actualites['count'];
        }

        return $this->render('actualitesstat/stat.html.twig', [

            'dates' => json_encode($dates),
            'Countactualites' => json_encode($Countactualites),
        ]);

    }
}
