<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Groupeuser;
use App\Entity\User;
use App\Repository\GroupeuserRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeuserController extends AbstractController
{
    /**
     * @Route("/DisplayMembers/{id}", name="DisplayMembers")
     */
    public function index($id,GroupeuserRepository $repo,UserRepository $repo2 ): Response
    {
        $u1=new User();
        $ar=array(new User());
        $g=new Groupeuser();
        $repo=$this->getDoctrine()->getRepository(Groupeuser::class);
        $groupeuser=$repo->findBy([
            "idGroupe"=>$id
        ]);
        $i=0;
        foreach ($groupeuser as $g){
            $repo2=$this->getDoctrine()->getRepository(User::class);
            $u=$repo2->findBy([
                "idUser"=>$g->getIdUser()
            ]);

            foreach ($u as $u1) {
                $u2=new User();
                $u2->setNomUser($u1->getNomUser());
                $u2->setScoreUser($u1->getScoreUser());
                $ar[$i]=$u2;
            }
            $i++;
    }


        return $this->render('groupeuser/index.html.twig', [
            "ar" => $ar
        ]);
    }
}
