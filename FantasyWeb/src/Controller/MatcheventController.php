<?php

namespace App\Controller;

use App\Entity\Matchevent;
use App\Form\MatcheventType;
use App\Repository\FavmatchRepository;
use App\Repository\MatcheventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @Route ("/timeleft/{id}", name="timeleft")
     */
    public function timeleft($id,MatcheventRepository $repo)
    {
        $matchevent=$repo->findOneBy(['idmatch' => $id]);
        $ar=explode('-',$matchevent->getDatematch());
        return $this->render('matchevent/timeleft.html.twig',
            ['m'=>$matchevent,'y'=>$ar[0],'mm'=>$ar[1]-1,'d'=>$ar[2]]);
    }

    /**
     * @param MatcheventRepository $repo
     * @return Response
     * @Route ("/DisplayMatch", name="DisplayMatch")
     */
    public function DisplayMatch(MatcheventRepository $repo)
    {
        $idu=1;
        $matchevent=$repo->findAll();
        foreach ($matchevent as $e){
            $obj = new \DateTime();
            $dmy = $obj->format('Y-m-d');
            $timestamp1 = strtotime($e->getDatematch());
            $timestamp2 = strtotime($dmy);
            if($timestamp1 < $timestamp2) {

                $em=$this->getDoctrine()->getManager();
                $em->remove($e);
                $em->flush();
                return $this->render('matchevent/DisplayMatch.html.twig',
                    ['matchevent'=>$matchevent,'j'=>'Le(s) matche(s) passé ont été effacée(s)']);
            }
        }
        return $this->render('matchevent/DisplayMatch.html.twig',
            ['matchevent'=>$matchevent,'j'=>'']);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddMatch", name="AddMatch")
     */
    public function AddMatch(Request $request)
    {
        $matchevent=new Matchevent();
        $form=$this->createForm(MatcheventType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $obj = new \DateTime();
            $dmy = $obj->format('Y-m-d');
            $timestamp1 = strtotime($form['datematch']->getData());
            $timestamp2 = strtotime($dmy);
            if ($timestamp1 < $timestamp2){
                return $this->render('matchevent/AddMatch.html.twig',
                    ['form'=>$form->createView(),'err'=>"● Cette date a deja passé."]);
            }else{
            $matchevent->setTitre($form['titre']->getData());
            $matchevent->setDatematch($form['datematch']->getData());
            $equipe = $form['idEquipea']->getData();
            $matchevent->setIdEquipea($equipe);
            $EquipeA = $form['idEquipeb']->getData();
            $matchevent->setIdEquipeb($EquipeA);
            $em=$this->getDoctrine()->getManager();
            $em->persist($matchevent);
            $em->flush();
            return $this->redirectToRoute('DisplayMatch');
            }
        }
        return $this->render('matchevent/AddMatch.html.twig',
            ['form'=>$form->createView(),'err'=>'']);
    }

    /**
     * @param $id
     * @param MatcheventRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/Deletematch/{id}", name="Deletematch")
     */
    public function Deletematch($id,MatcheventRepository $repo)
    {
        $match=$repo->findOneBy(['idmatch' => $id]);
        $em=$this->getDoctrine()->getManager();
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute('DisplayMatchformanager');
    }

//    /**
//     *@param Request $request
//     * @return Response
//     * @Route ("/UpdatePlayer/{id}", name="UpdatePlayer")
//     */
//    public function UpdateJoueur(JoueurRepository $repo,$id,Request $request)
//    {
//        $joueur=$repo->find($id);
//        $form=$this->createForm(JoueurType::class,$joueur);
//        $form->add('Update',SubmitType::class);
//        $form->handleRequest($request);
//        if($form->isSubmitted()&&$form->isValid()){
//            $em=$this->getDoctrine()->getManager();
//            $em->flush();
//            return $this->redirectToRoute('DisplayPlayersForManager');
//        }
//        return $this->render('joueur/UpdatePlayer.html.twig',
//            ['form'=>$form->createView()]);
//    }
}
