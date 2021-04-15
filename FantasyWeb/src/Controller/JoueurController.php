<?php

namespace App\Controller;
use App\Entity\Joueur;
use App\Form\JoueurType;
use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur", name="joueur")
     */
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayers", name="DisplayPlayers")
     */
    public function DisplayPlayers(JoueurRepository $repo)
    {
        $joueur=$repo->findAll();
        return $this->render('joueur/DisplayPlayers.html.twig',
            ['joueur'=>$joueur]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayersForManager", name="DisplayPlayersForManager")
     */
    public function DisplayPlayersForAdmin(JoueurRepository $repo)
    {
        $joueur=$repo->findAll();
        return $this->render('joueur/DisplayPlayersForManager.html.twig',
            ['joueur'=>$joueur]);
    }

    /**
     * @param JoueurRepository $repo
     * @Route ("/DeletePlayer/{id}", name="DeletePlayer")
     */
    public function DeleteJoueur($id,JoueurRepository $repo)
    {
        $player=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($player);
        $em->flush();
        return $this->redirectToRoute('DisplayPlayersForManager');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddPlayer", name="AddPlayer")
     */
    public function AddPlayer(Request $request)
    {
        $Joueur=new Joueur();
        $form=$this->createForm(JoueurType::class,$Joueur);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $Equipe = $form['idEquipe']->getData();
            $Joueur->setIdEquipe($Equipe);
            $em=$this->getDoctrine()->getManager();
            $em->persist($Joueur);
            $em->flush();
            return $this->redirectToRoute('DisplayPlayersForManager');
        }
        return $this->render('joueur/AddPlayer.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     *@param Request $request
     * @return Response
     * @Route ("/UpdatePlayer/{id}", name="UpdatePlayer")
     */
    public function UpdateJoueur(JoueurRepository $repo,$id,Request $request)
    {
        $player=$repo->find($id);
        $form=$this->createForm(JoueurType::class,$player);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('DisplayPlayersForManager');
        }
        return $this->render('joueur/UpdatePlayer.html.twig',
            ['form'=>$form->createView()]);
    }
    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayersForEquipe/{id}", name="DisplayPlayersForEquipe")
     */
    public function DisplayPlayersForEquipe(JoueurRepository $repo,$id)
    {
        $joueur=$repo->findBy(array('idEquipe' => $id));
        return $this->render('joueur/DisplayPlayers.html.twig',
            ['joueur'=>$joueur]);
    }
}
