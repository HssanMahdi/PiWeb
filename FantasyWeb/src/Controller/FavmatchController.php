<?php

namespace App\Controller;

use App\Entity\Favmatch;
use App\Entity\Matchevent;
use App\Repository\EquipeRepository;
use App\Repository\FavmatchRepository;
use App\Repository\MatcheventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavmatchController extends AbstractController
{
    /**
     * @Route("/favmatch/{id}", name="favmatch")
     * @param $id
     * @param FavmatchRepository $repo
     * @return Response
     */
    public function index($id,FavmatchRepository $repo): Response
    {
        $idu=1;
        $favm= new Favmatch();
        $fav=$repo->findBy(['idUser' => $idu,'idmatch'=>$id]);
        if($fav){
            return $this->redirectToRoute('DisplayMatch');
        }else{
        $favm->setIdUser($idu);
        $favm->setIdmatch($id);
        $em=$this->getDoctrine()->getManager();
        $em->persist($favm);
        $em->flush();
        return $this->redirectToRoute('Displayfav');
        }
    }

    /**
     * @param FavmatchRepository $repo
     * @param MatcheventRepository $repo1
     * @return Response
     * @Route ("/Displayfav", name="Displayfav")
     */
    public function Displayfav(FavmatchRepository $repo,MatcheventRepository $repo1,EquipeRepository $repo2): Response
    {
        $idu=1;
        $mte= new Matchevent();
        $ar=array(new Matchevent());
        $fav=$repo->findBy(['idUser' => $idu]);
        $i=0;
        foreach ($fav as $m){
            $mte=$repo1->findOneBy(['idmatch'=>$m->getIdmatch()]);
            $imA = $repo2->findOneBy(array('idEquipe' => $mte->getIdEquipea()));
            $imB = $repo2->findOneBy(array('idEquipe' => $mte->getIdEquipeb()));
            $mte->setImageA($imA->getLogoEquipe());
            $mte->setImageB($imB->getLogoEquipe());
            $ar[$i]=$mte;
            $i++;
        }
        return $this->render('favmatch/index.html.twig',
            ['matchevent'=>$ar]);
    }

    /**
     * @param FavmatchRepository $repo
     * @Route ("/Deletefav/{id}", name="Deletefav")
     */
    public function Deletefav($id,FavmatchRepository $repo)
    {
        $fav=$repo->findOneBy(['idmatch'=>$id]);
        $em=$this->getDoctrine()->getManager();
        $em->remove($fav);
        $em->flush();
        return $this->redirectToRoute('Displayfav');
    }

}
