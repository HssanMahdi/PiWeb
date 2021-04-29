<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Formjoueur;
use App\Entity\Joueur;
use App\Repository\FormationRepository;
use App\Repository\FormjoueurRepository;
use App\Repository\JoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function index(FormationRepository $repo,FormjoueurRepository $repo1,JoueurRepository $repo2): Response
    {
        $idu=1;
        $idf=$repo->findFormationByUser($idu)->getIdFormation();
        $j1=new Joueur();
        $ar=array(new Joueur());
        $repo1=$this->getDoctrine()->getRepository(Formjoueur::class);
        $formjoueur=$repo1->findBy([
            "idFormation"=>$idf
        ]);
        $i=0;
        foreach ($formjoueur as $j){
            $repo2=$this->getDoctrine()->getRepository(Joueur::class);
            $j=$repo2->findBy([
                "idJoueur"=>$j->getIdJoueur()
            ]);

            foreach ($j as $j1) {
                $j2=new Joueur();
                $j2->setNomJoueur($j1->getNomJoueur());
                $j2->setPrenomJoueur($j1->getPrenomJoueur());
                $j2->setLogoJoueur($j1->getLogoJoueur());
                $j2->setPrixJoueur($j1->getPrixJoueur());
                $j2->setPosition($j1->getPosition());
                $j2->setIdJoueur($j1->getIdJoueur());
                $ar[$i]=$j2;
            }
            $i++;
        }
        return $this->render('formation/index.html.twig', [
            'ar' => $ar,
        ]);
    }

    /**
     *
     * @Route ("/DeleteFormjoueur/{id}", name="DeleteFormjoueur")
     */
    public function DeleteJoueur($id,FormationRepository $repo,FormjoueurRepository $repo1)
    {
        $idu=1;
        $idf=$repo->findFormationByUser($idu)->getIdFormation();

        $formjoueur=$repo1->findOneBy([
            "idJoueur"=>$id,
            "idFormation"=>$idf
        ]);
        $em=$this->getDoctrine()->getManager();
        $em->remove($formjoueur);
        $em->flush();
        return $this->redirectToRoute('formation');
    }
}