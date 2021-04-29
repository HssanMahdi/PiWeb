<?php

namespace App\Controller;

use App\Entity\Leavegroupe;
use App\Repository\GroupeuserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeavegroupeController extends AbstractController
{

    /**
     * @Route("/leavegroupe/{id}", name="leavegroupe")
     */
    public function index($id): Response
    {

        return $this->render('leavegroupe/index.html.twig', [
            'id' => $id,
        ]);
    }

    /**
     * @Route("/quit/{id}/{rep}", name="quit")
     * @return Response
     */
    public function quit($id,$rep,GroupeuserRepository $repo)
    {
        $idu=1;
        $repo->deleteUserdeGroupe($idu,$id);
        if($rep=="o"){
            $lg= new Leavegroupe();
            $lg->setIdGroupe($id);
            $lg->setIdUser($idu);
            $em=$this->getDoctrine()->getManager();
            $em->persist($lg);
            $em->flush();
        }
        return $this->redirectToRoute('DisplayGroupesMem');
    }

}
