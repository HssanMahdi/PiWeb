<?php

namespace App\Controller;

use App\Repository\GroupeRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
//    public function DisplayOwned(Integer idu)
//    {
//        $repo=$this->getDoctrine()->getRepository(GroupeRepository::class);
//        $groupe=$repo->findBy();
//
//    }
}
