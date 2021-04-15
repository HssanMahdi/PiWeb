<?php

namespace App\Controller;

use App\Entity\Matchevent;
use App\Form\MatcheventType;
use App\Repository\JoueurRepository;
use App\Repository\MatcheventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MatcheventController extends AbstractController
{
    /**
     * @Route("/matchevent", name="matchevent")
     */
    public function index(): Response
    {
        return $this->render('matchevent/index.html.twig', [
            'controller_name' => 'MatcheventController',
        ]);
    }


    /**
     * @param MatcheventRepository $repo
     * @return Response
     * @Route ("/DisplayMatch", name="DisplayMatch")
     */
    public function DisplayMatch(MatcheventRepository $repo)
    {
        $matchevent=$repo->findAll();
        return $this->render('matchevent/DisplayMatch.html.twig',
            ['matchevent'=>$matchevent]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddMatch", name="AddMatch")
     */
    public function AddMatch(Request $request)
    {
        $matchevent=new Matchevent();
        $form=$this->createForm(MatcheventType::class,$matchevent);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $obj = new \DateTime();
            $dmy = $obj->format('d-m-Y');
            $matchevent->setDatematch($dmy);
            $equipe = $form['idEquipea']->getData();
            $matchevent->setIdEquipea($equipe);
            $EquipeA = $form['idEquipeb']->getData();
            $matchevent->setIdEquipeb($EquipeA);
            $em=$this->getDoctrine()->getManager();
            $em->persist($matchevent);
            $em->flush();
            return $this->redirectToRoute('DisplayMatch');
        }
        return $this->render('matchevent/AddMatch.html.twig',
            ['form'=>$form->createView()]);
    }
}
