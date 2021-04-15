<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\User;
use App\Form\AdherentType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    /**
     * @Route("/adherent", name="adherent")
     */
    public function index(): Response
    {
        return $this->render('adherent/index.html.twig', [
            'controller_name' => 'AdherentController',
        ]);
    }

    /**
     * @param UserRepository $repo
     * @return Response
     * @Route ("/Affiche")
     */

    public function Affiche(){
        $repo=$this->getDoctrine()->getRepository(User::class);
        $User=$repo->findBy(['typeUser'=> 'ad']);
        return $this->render( 'adherent/DisplayAdherent.html.twig',['user'=>$User,
        ]);
    }

    /**
     * @Route ("/DeleteAd/{idUser}",name="d")
     */

   public function DeleteAd(UserRepository $repo,$idUser)
        {$User=$repo->find($idUser);
        $em=$this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();
        return $this->redirectToRoute('Affiche');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("adherent/Add")
     */
    public function Add(Request $request){
        $Adherent=new Adherent();
        $Adherent->setTypeUser('ad');
        $form = $this->createForm(AdherentType::Class,$Adherent);
        $form->add('Ajouter',SubmitType::Class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Adherent);
            $entityManager->flush();
        }
        return $this->render('adherent/Add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

/**
 * @param Request $request
 * @return Response
 * @Route ("adherent/Update/{idUser}",name="update1")
 */

  public function Update(UserRepository $repository,$idUser,Request $request){
      $adherent=$repository->find($idUser);
      $form=$this->createForm(AdherentType::class,$adherent);
      $form->add('Update',SubmitType::class);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($adherent);
          $entityManager->flush();
          return $this->redirectToRoute("Affiche");
      }
          return  $this->render('adherent/Update.html.twig',
              [
                  'form'=>$form->createView()
              ]);
  }

}
