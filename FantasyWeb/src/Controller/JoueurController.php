<?php

namespace App\Controller;
use App\Entity\Joueur;
use App\Entity\Rating;
use App\Form\JoueurType;
use App\Form\RatingType;
use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

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
    public function DisplayPlayers(JoueurRepository $repo,RatingRepository $repo1)
    {
        $joueur=$repo->findAll();
        $ar=array(new Joueur());
        $i=-1;
        foreach ($joueur as $j){
            $i++;
            $moy=$repo1->av($j->getIdJoueur());
                $j->setRating($moy);
                $ar[$i]=$j;

        }
        return $this->render('joueur/DisplayPlayers.html.twig',
            ['joueur'=>$ar]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayerForManager", name="DisplayPlayerForManager")
     */
    public function DisplayPlayerForAdmin(JoueurRepository $repo)
    {
        $joueur=$repo->findAll();
        return $this->render('joueur/DisplayPlayerForManager.html.twig',
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
        return $this->redirectToRoute('DisplayPlayerForManager');
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
            $image1File = $form->get('logoJoueur')->getData();
            /** @var UploadedFile $image1File */

            if ($image1File) {
                $originalFilename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image1File->guessExtension();
                $image1File->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $Joueur->setLogoJoueur($newFilename);
            }
            $em->persist($Joueur);
            $em->flush();
            return $this->redirectToRoute('DisplayPlayerForManager');
        }
        return $this->render('joueur/AddPlayers.html.twig',
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
            $image1File = $form->get('logoJoueur')->getData();
            /** @var UploadedFile $image1File */

            if ($image1File) {
                $originalFilename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image1File->guessExtension();
                $image1File->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $player->setLogoJoueur($newFilename);
            }
            $em->flush();
            return $this->redirectToRoute('DisplayPlayerForManager');
        }
        return $this->render('joueur/UpdatePlayers.html.twig',
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


    /**
     * @Route("/DisplayRating/{id}", name="DisplayRating")
     */
    public function DisplayRating($id)
    {
        return $this->render('rating/index.html.twig',
             ['idJoueurRating'=>$id]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddRates/{id}", name="AddRates")
     */
    public function AddRates(Request $request,RatingRepository $repo,$id)
    {
        $Rating=new Rating();
        $form=$this->createForm(RatingType::class,$Rating);
        $form->handleRequest($request);
        $Rating->setIdUser(7);
        if($form->isSubmitted()&&$form->isValid()){
            $res=$repo->testExist($Rating->getIdUser(),$id);
            if($res){
                $rat=$repo->findOneBy(array('idJoueur' => $id));
                $em=$this->getDoctrine()->getManager();
                $em->remove($rat);
                $em->flush();
            }
            $Rating->setIdJoueur($id);
            $em=$this->getDoctrine()->getManager();
            $em->persist($Rating);
            $em->flush();
            return $this->redirectToRoute('DisplayPlayers');

        }
        return $this->render('rating/index.html.twig',
            ['form'=>$form->createView()]);
    }


}
