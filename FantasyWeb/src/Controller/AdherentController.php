<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\User;
use App\Form\AdherentType;
use App\Form\EditProfileType;
use App\Form\LoginType;
use App\Repository\UserRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
     * @Route ("/Affiche",name="Affiche")
     */

    public function Affiche(UserRepository $repo){
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
     * @Route ("adherent/Add", name="Add")
     */
    public function Add(Request $request,UserPasswordEncoderInterface  $encoder){
        $Adherent=new Adherent();
        $Adherent->setTypeUser('ad');
        $form = $this->createForm(AdherentType::Class,$Adherent);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($Adherent,$Adherent->getPassword());
            $Adherent->setPassword($hash);
            //generation du token d activation
            $Adherent->setActivationToken(md5(uniqid()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Adherent);
            $entityManager->flush();
            return $this->redirectToRoute('loginUser');
        }
        return $this->render('adherent/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

/**
 * @param Request $request
 * @return Response
 * @Route ("adherent/Update/{idUser}",name="update1")
 */

  public function Update(UserRepository $repository,$idUser,Request $request ){
      $adherent=$repository->find($idUser);
      $form=$this->createForm(AdherentType::class,$adherent);

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

  /*  /**
     * @return Response
     * @Route ("/connexion", name="login")

     */

//  public function login(){
//
//      return $this->render('adherent/login.html.twig');
  //}
    /**
     * @return Response
     * @param UserRepository $repo
     * @Route ("/loginUser", name="loginUser")

     */
    public function LoginAction(Request $request,UserRepository $repo)
    {
        $user = new User();
        $Form = $this->createForm(LoginType::class, $user);
        $Form->handleRequest($request);

        if ($Form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $userdb = new User();
            $userdb = $repo->findOneBy([
                'nomUser' => $user->getNomUser()
            ]);
            if($userdb){
            if(($userdb->getPassword() == $user->getPassword()) )  {

                if($userdb->getTypeUser()=='ad'){
                    return $this->redirectToRoute("Affiche");
                } elseif ($userdb->getTypeUser()=='adS'){
                    return $this->redirectToRoute("AfficheAd");
                } elseif($userdb->getTypeUser()=='MF'){
                    return $this->redirectToRoute("AfficheManager");

                }else{
                    return $this->render( 'adherent/login.html.twig');}

            }
        }}

        return $this->render('adherent/login.html.twig', array(
            'form' => $Form->createView()
        ));
    }


    /**
     * @param Request $request
     * @return Response
     * @Route ("adherent/modifierprofile",name="profile_modifier")
     */
    public function editprofile (Request $request){
        $user=$this->getUser();
        $form = $this->createForm(EditProfileType::Class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('string','profil mis a jour');
            return $this->redirectToRoute('adherent');
        }
        return $this->render('adherent/editprofil.html.twig', ['user'=>$user,
        ],[
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route ("/activation/{token}", name="activation")
     */
    public function activation($token, UserRepository $Repo){
        //si un utilisateur a ce token
        $user=$Repo->findOneBy(['activation_token'=>$token]);
        //si aucun utilisateur n'existe avec ce token
        if(!$user) {
            //Erreur 404
            throw $this->createNotFoundException('Cet utilisateur n existe pas');
        }
        //On supprime le token
        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        //on envoie un message flash
        $this->addFlash('message','Vous avez bien active votre compte');

        //retour a l'accueil
        return $this->redirectToRoute('first');

    }

}
