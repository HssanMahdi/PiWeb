<?php

namespace App\Controller;

use App\Entity\ManagerFootball;
use App\Entity\User;
use App\Form\ManagerType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class ManagerFootballController extends AbstractController
{
    /**
     * @Route("/manager/football", name="manager_football")
     */
    public function index(): Response
    {
        return $this->render('manager_football/index.html.twig', [
            'controller_name' => 'ManagerFootballController',
        ]);
    }
    /**
     * @param UserRepository $repo
     * @return Response
     * @Route ("/AfficheManager", name="AfficheManager")
     */

    public function AfficheManager(UserRepository $repo){
        $User=$repo->findBy(['typeUser'=> 'MF']);
        return $this->render( 'manager_football/DisplayManager.html.twig',['user'=>$User,
        ]);
    }

    /**
     * @Route ("/DeleteMF/{idUser}",name="delete")
     */

    public function DeleteMF($idUser, UserRepository $repo){
        $User=$repo->find($idUser);
        $em=$this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();
        return $this->redirectToRoute('AfficheManager');
    }

    /**
     *   * @param Request $request
     * @return Response
     * @Route ("manager_football/Add", name="Add3")
     */
    public function Add(Request $request){
        $ManagerFootball=new ManagerFootball() ;
        $ManagerFootball->setTypeUser('MF');
        $form = $this->createForm(ManagerType::Class,$ManagerFootball);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ManagerFootball);
            $entityManager->flush();
            return $this->redirectToRoute('AfficheManager');

        }
        return $this->render('manager_football/Add.html.twig', [
            'form'=>$form->createView()
        ]);
    }
    /**
     *@param Request $request
     * @return Response
     * @Route ("manager_football/Update/{idUser}", name="update")
     */
    public function Update(UserRepository $repository,$idUser,Request $request)
    {
        $manager=$repository->find($idUser);
        $form=$this->createForm(ManagerType::class,$manager);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheManager');
        }
        return $this->render('manager_football/Update.html.twig',
            ['form'=>$form->createView()]);
    }
    /**
     * @Route ("manager_football/recherche",name="recherche")
     */
    public function recherche(UserRepository $repository,Request $request){
        $data=$request->get('search1');
        $User=$repository->findBy(['nomUser'=>$data]);
        return $this->render('manager_football/DisplayManager.html.twig',['user'=>$User,
        ]);

    }

}
