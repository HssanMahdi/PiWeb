<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\User;
use App\Form\GroupeType;
use App\Repository\GroupeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe", name="groupe")
     */
    public function index(): Response
    {
        return $this->render('groupe/index.html.twig', [
            'controller_name' => 'GroupeController',
        ]);
    }
        /**
     * @param GroupeRepository $repo
     * @return Response
     * @Route ("/DisplayGroupes", name="DisplayGroupes")
     */
    public function DisplayOwned()
    {
        $idu=1;
        $repo=$this->getDoctrine()->getRepository(Groupe::class);
        $groupe=$repo->findBy([
            "owner"=>$idu
        ]);

        return $this->render('groupe/DisplayGroupes.html.twig',
              ['groupe'=>$groupe]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/AddGroupe", name="AddGroupe")
     */
    public function AddGroupe(Request $request)
    {
        $idu=1;
        $groupe=new Groupe();
        $groupe->setOwner($idu);
        $form=$this->createForm(GroupeType::class,$groupe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();
            return $this->redirectToRoute('DisplayGroupes');
        }
        return $this->render('groupe/AddGroupe.html.twig',
            ['form'=>$form->createView()]);
    }
    /**
     *@param Request $request
     * @return Response
     * @Route ("/UpdateGroupe/{id}", name="UpdateGroupe")
     */
    public function UpdateGroupe(GroupeRepository $repo,$id,Request $request)
    {
        $groupe=$repo->find($id);
        $form=$this->createForm(GroupeType::class,$groupe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('DisplayGroupes');
        }
        return $this->render('groupe/UpdateGroupe.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     * @param GroupeRepository $repo
     * @Route ("/DeleteGroupe/{id}", name="DeleteGroupe")
     */
    public function DeleteJoueur($id,GroupeRepository $repo)
    {
        $groupe=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($groupe);
        $em->flush();
        return $this->redirectToRoute('DisplayGroupes');
    }
//    /**
//     * @param GroupeRepository $repo
//     * @return Response
//     * @Route ("/DisplayGroupes", name="DisplayGroupes")
//     */
//    public function DisplayGroupes(GroupeRepository $repo)
//    {
//        $groupe=$repo->findBy(['owner' => 1]);
//        return $this->render('groupe/index.html.twig',
//            ['groupe'=>$groupe]);
//    }
    /**
     * @Route("/DisplayGroupeFormanager", name="DisplayGroupeFormanager")
     */
    public function DisplayGroupeFormanager(GroupeRepository $repo): Response
    {
        $groupe=$repo->findAll();
        return $this->render('groupe/DisplayGroupeFormanager.html.twig', [
            'groupe' =>$groupe ,
        ]);
    }

}
