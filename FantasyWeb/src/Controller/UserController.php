<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")

     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    /**
     * @param UserRepository $repo
     * @return Response
     * @Route ("/AfficheC")
     */
    public function Affiche(){
        $repo=$this->getDoctrine()->getRepository(User::class);
        $User=$repo->findAll();
        return $this->render( 'AdherentType/DisplayUser.html.twig',['user'=>$User,
        ]);
    }
}
