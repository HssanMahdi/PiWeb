<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function index(): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }
    /**
     * @param EquipeRepository $repo
     * @return Response
     * @Route ("/DisplayEquipe", name="DisplayEquipe")
     */
    public function DisplayEquipe(EquipeRepository $repo)
    {
        $equipe=$repo->findAll();
        return $this->render('equipe/DisplayEquipe.html.twig',
            ['equipe'=>$equipe]);
    }

    /**
     * @param EquipeRepository $repo
     * @return Response
     * @Route ("/DisplayEquipesForManager", name="DisplayEquipesForManager")
     */
    public function DisplayEquipeForManager(EquipeRepository $repo)
    {
        $equipe=$repo->findAll();
        return $this->render('equipe/DisplayEquipesForManager.html.twig',
            ['equipe'=>$equipe]);
    }

    /**
     * @param EquipeRepository $repo
     * @Route ("/DeleteEquipe/{id}", name="DeleteEquipe")
     */
    public function DeleteEquipe($id,EquipeRepository $repo,JoueurRepository $repo2)
    {
        $repo2->deleteJoueurdEquipe($id);
        $equipe=$repo->findOneBy([
            "idEquipe" => $id
        ]);
        $em=$this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('DisplayEquipesForManager');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddEquipe", name="AddEquipe")
     */
    public function AddEquipe(Request $request)
    {
        $Equipe=new Equipe();
        $form=$this->createForm(EquipeType::class,$Equipe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $image1File = $form->get('logoEquipe')->getData();
            /** @var UploadedFile $image1File */

            if ($image1File) {
                $originalFilename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image1File->guessExtension();
                $image1File->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $Equipe->setLogoEquipe($newFilename);
            }
            $em->persist($Equipe);
            $em->flush();
            return $this->redirectToRoute('DisplayEquipesForManager');
        }
        return $this->render('equipe/AddEquipes.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     *@param Request $request
     * @return Response
     * @Route ("/UpdateEquipe/{id}", name="UpdateEquipe")
     */
    public function UpdateEquipe(EquipeRepository $repo,$id,Request $request)
    {
        $equipe=$repo->find($id);
        $form=$this->createForm(EquipeType::class,$equipe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $em=$this->getDoctrine()->getManager();

             $image1File = $form->get('logoEquipe')->getData();
            /** @var UploadedFile $image1File */

            if ($image1File) {
                $originalFilename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image1File->guessExtension();
                $image1File->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $equipe->setLogoEquipe($newFilename);
            }
            $em->flush();
            return $this->redirectToRoute('DisplayEquipesForManager');
        }
        return $this->render('equipe/UpdateEquipe.html.twig',
            ['form'=>$form->createView()]);
    }

}
