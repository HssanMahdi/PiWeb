<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Repository\UserRepository;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/loginUser", name="loginUser")
     */
    public function loginUser(AuthenticationUtils $authenticationUtils, Request $request,UserRepository $repo): Response
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
                        return $this->redirectToRoute("user");
                    } elseif ($userdb->getTypeUser()=='adS'){
                        return $this->redirectToRoute("AfficheAd");
                    } elseif($userdb->getTypeUser()=='MF'){
                        return $this->redirectToRoute("DisplayPlayerForManager");

                    }else{
                        return $this->render( 'Security/login.html.twig');}

                }
            }}

        return $this->render('Security/login.html.twig', array(
            'form' => $Form->createView()
        ));

    }






    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

    }
}
