<?php

namespace App\Controller;

use App\Entity\AdminSysteme;
use App\Form\AdminType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSystemeController extends AbstractController
{
    /**
     * @Route("/admin/systeme", name="admin_systeme")
     */
    public function index(): Response
    {
        return $this->render('admin_systeme/index.html.twig', [
            'controller_name' => 'AdminSystemeController',
        ]);
    }

    /**
     * @param UserRepository $repo
     * @return Response
     * @Route ("/AfficheAd")
     */

    public function AfficheAd(UserRepository $repo){
        $User=$repo->findBy(['typeUser'=> 'adS']);
        return $this->render( 'admin_systeme/DisplayAdmin.html.twig',['user'=>$User,
        ]);
    }

    /**
     * @Route ("/DeleteAdS/{idUser}",name="d")
     */

    public function DeleteAdS($idUser, UserRepository $repo){
        $User=$repo->find($idUser);
        $em=$this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();
        return $this->redirectToRoute('AfficheAd');
    }
    /**
     * @param Request $request
     * @return Response
     * @Route ("admin_systeme/Add")
     */
    public function Add(Request $request){
        $AdminSysteme=new AdminSysteme();
        $AdminSysteme->setTypeUser('adS');
        $form = $this->createForm(AdminType::class,$AdminSysteme);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($AdminSysteme);
            $entityManager->flush();
        }
        return $this->render('admin_systeme/Add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/admin_systeme/Update/{idUser}",name="up")
     */

    public function Update(UserRepository $repository,$idUser,Request $request){
        $admin_systeme=$repository->find($idUser);
        $form=$this->createForm(AdminType::class,$admin_systeme);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($admin_systeme);
            $entityManager->flush();
            return $this->redirectToRoute("AfficheAd");
        }
        return  $this->render('admin_systeme/Update.html.twig',
            [
                'form'=>$form->createView()
            ]);
    }


}
