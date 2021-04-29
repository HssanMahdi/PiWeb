<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Groupeuser;
use App\Entity\User;
use App\Form\AddserType;
use App\Repository\GroupeRepository;
use App\Repository\GroupeuserRepository;
use App\Repository\LeavegroupeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @return Response
     * @Route ("/DisplayGroupesMem", name="DisplayGroupesMem")
     */
    public function DisplayGroupesMem (GroupeuserRepository $repo,GroupeRepository $repo2)
    {
        $idu = 1;
        $ar = array(new Groupe());
        $g = new Groupeuser();
        $g1 = new Groupe();
        $repo = $this->getDoctrine()->getRepository(Groupeuser::class);
        $groupeuser = $repo->findBy([
            "idUser" => $idu
        ]);
        $i = 0;
        foreach ($groupeuser as $g) {
            $repo2 = $this->getDoctrine()->getRepository(Groupe::class);
            $gr = $repo2->findBy([
                "idGroupe" => $g->getIdGroupe()
            ]);

            foreach ($gr as $g1) {
                $g2 = new Groupe();
                $g2->setIdGroupe($g1->getIdGroupe());
                $g2->setNomGroupe($g1->getNomGroupe());
                $ar[$i] = $g2;
            }
            $i++;
        }
        return $this->render('groupeuser/DisplayGroupesMem.html.twig', [
            "groupe" => $ar
        ]);
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/AddMember/{id}", name="AddMember")
     */
    public function AddMember ($id,Request $request,UserRepository $repo1,GroupeuserRepository $repo,LeavegroupeRepository $repo3)
    {
        $idu=1;
        $u= new User();
        $groupeuser= new Groupeuser();
        $form=$this->createForm(AddserType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $data=$form->getData();
            foreach ($data as $e){
                $email=$e;
            }
            $u=$repo1->findbyEmail($e);
            if($u){
                //$repo = $this->getDoctrine()->getRepository(Groupeuser::class);
                if($repo->findUser($id,$u->getIdUser())){
                    return $this->render('groupeuser/AddMember.html.twig',
                        ['form'=>$form->createView(),'err'=>'● Cet utilisateur est déja un membre']);
                }else{
                    if($repo3->findUser($id,$u->getIdUser())){
                        return $this->render('groupeuser/AddMember.html.twig',
                            ['form'=>$form->createView(),'err'=>'● Cet utilisateur a quitter ce groupe définitivement']);
                    }else{
                    $groupeuser->setIdUser($u->getIdUser());
                    $groupeuser->setIdGroupe($id);
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($groupeuser);
                    $em->flush();
                    return $this->redirectToRoute('DisplayGroupes');
                    }
                }

            }else{
                return $this->render('groupeuser/AddMember.html.twig',
                    ['form'=>$form->createView(),'err'=>'● Cet utilisateur n existe pas']);
            }


        }
        return $this->render('groupeuser/AddMember.html.twig',
            ['form'=>$form->createView(),'err'=>'']);
    }


}


