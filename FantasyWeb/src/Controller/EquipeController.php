<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function index(): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }
    /**
     * @param EquipeRepository $repo
     * @return Response
     * @Route ("/DisplayEquipe", name="DisplayEquipe")
     */
    public function DisplayEquipe(EquipeRepository $repo)
    {
        $equipe=$repo->findAll();
        return $this->render('equipe/DisplayEquipe.html.twig',
            ['equipe'=>$equipe]);
    }

    /**
     * @param EquipeRepository $repo
     * @return Response
     * @Route ("/DisplayEquipeForManager", name="DisplayEquipeForManager")
     */
    public function DisplayEquipeForManager(EquipeRepository $repo)
    {
        $equipe=$repo->findAll();
        return $this->render('equipe/DisplayEquipeForManager.html.twig',
            ['equipe'=>$equipe]);
    }

    /**
     * @param EquipeRepository $repo
     * @Route ("/DeleteEquipe/{id}", name="DeleteEquipe")
     */
    public function DeleteEquipe($id,EquipeRepository $repo)
    {
        $equipe=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('DisplayEquipeForManager');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddEquipe", name="AddEquipe")
     */
    public function AddEquipe(Request $request)
    {
        $Equipe=new Equipe();
        $form=$this->createForm(EquipeType::class,$Equipe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Equipe);
            $em->flush();
            return $this->redirectToRoute('DisplayEquipeForManager');
        }
        return $this->render('equipe/AddEquipe.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     *@param Request $request
     * @return Response
     * @Route ("/UpdateEquipe/{id}", name="UpdateEquipe")
     */
    public function UpdateEquipe(EquipeRepository $repo,$id,Request $request)
    {
        $equipe=$repo->find($id);
        $form=$this->createForm(EquipeType::class,$equipe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('DisplayEquipeForManager');
        }
        return $this->render('equipe/UpdateEquipe.html.twig',
            ['form'=>$form->createView()]);
    }

}
