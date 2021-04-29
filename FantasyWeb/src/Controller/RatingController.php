<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Form\RatingType;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    /**
     * @Route("/rating", name="rating")
     */
    public function index(): Response
    {
        return $this->render('rating/index.html.twig', [
            'controller_name' => 'RatingController',
        ]);
    }

    /**
     * @param RatingRepository $repo
     * @Route ("/DeleteAvis/{id}", name="DeleteAvis")
     */
    public function DeleteAvis($id,RatingRepository $repo)
    {
        $rat=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rat);
        $em->flush();

    }

    /**
     * @Route("/TestTest/{id}", name="TestTest")
     */
    public function TestTest(RatingRepository $repo,$id)
    {
        $idU=2;
        $res=$repo->testExist($idU,$id);
        $tes=0;

        if($res){
            $tes=$tes+1;
        }


        return $this->render('rating/test.html.twig',
            ['tes'=>$tes]);
    }



}
