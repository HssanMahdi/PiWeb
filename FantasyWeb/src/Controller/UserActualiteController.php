<?php

namespace App\Controller;


use App\Entity\ActualitesLike;
use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CommentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActualitesLikeRepository;
use App\Repository\ActualiteRepository;
use App\Entity\Actualites;
use DateTime;
use App\Entity\User;
use App\Controller\ActualitesController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/user/actualite")
 */

class UserActualiteController extends AbstractController
{
    /**
     * @Route("/", name="user_actualite")
     */

    public function index(): Response
    {
        $actualites = $this->getDoctrine()
            ->getRepository(Actualites::class)
            ->findAll();

        return $this->render('user_actualite/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }



    /**
     * @Route("/{id}", name="show_actualite",methods={"GET"})
     */

    public function show($id,ActualiteRepository $actualiteRepository,Request $request): Response
    {
        $actualites = $actualiteRepository->findOneBy(['idActualites' => $id]);




        $comment = new Comments;

        // On génère le formulaire
        $commentForm = $this->createForm(CommentsType::class, $comment);

        $commentForm->handleRequest($request);

        // Traitement du formulaire
        if($commentForm->isSubmitted() && $commentForm->isValid()){
            $comment->setCreatedAt(new DateTime());
            $comment->setActualite($actualites);

            // On récupère le contenu du champ parentid
            $parentid = $commentForm->get("parentid")->getData();

            // On va chercher le commentaire correspondant
            $em = $this->getDoctrine()->getManager();

            if($parentid != null){
                $parent = $em->getRepository(Comments::class)->find($parentid);
            }

            // On définit le parent
            $comment->setParent($parent ?? null);

            $em->persist($comment);
            $em->flush();

            $this->addFlash('message', 'Votre commentaire a bien été envoyé');
            return $this->redirectToRoute('show_actualite', ['id' => $actualites->getIdActualites()]);
        }



        return $this->render('user_actualite/article.html.twig', [
            'actualites' => $actualites,
            'commentForm' => $commentForm->createView()
        ]);
    }



    /**
     * @param Actualites $act
     * @param EntityManagerInterface $manager
     * @param ActualitesLikeRepository $likeRepo
     * @return Response
     * @Route ("/actualite/{id}/like",name="actualites_like")
     */
   public function like(Actualites $act, EntityManagerInterface $manager,ActualitesLikeRepository $likeRepo):Response{

     // $user=$this->getUser();
     /*if(!$user) return $this->json([
          'code'=> 403,
          'message'=>'Unoauthorized'],403);

      if($act->islikedbyUser($user)){

          $like=$likeRepo->findOneBy([
              'actualite'=>$act,
              'user'=>$user
          ]);
           $manager->remove();
           $manager->flush();
          return $this->json([
              'code'=> 200,
              'message'=>'like bien supprimer',
              'likes'=> $likeRepo->count(['actualites'=>$act])],200);

          }*/

      $like= new ActualitesLike();
      $like->setActualites($act);
      $manager->persist($like);
      $manager->flush();

       return $this->json(['code'=> 200,
           'message'=>'like bien ajouter',
           'likes'=>$likeRepo->count(['actualites'=>$act])],200);


   }




}

