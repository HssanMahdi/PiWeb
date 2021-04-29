<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationType;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="publication")
     */
    public function index(): Response
    {
        return $this->render('publication/index.html.twig', [
            'controller_name' => 'PublicationController',
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddPub", name="AddPub")
     */
    public function AddPub(Request $request)
    {
        $pub=new Publication();
        $form=$this->createForm(PublicationType::class,$pub);
        $form->add('url',FileType::class,[
        'label' => 'Choisir le fichier',
        'constraints' => [
            new \Symfony\Component\Validator\Constraints\File([
                'maxSize' => '500M',
                'mimeTypes' => [
                    'video/mp4',
                ],
                'mimeTypesMessage' => 'Please upload a valid video file',
            ])
        ],
    ]);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $obj = new \DateTime();
            $dmy = $obj->format('d-m-Y');
            $pub->setDatePub($dmy);
            $em=$this->getDoctrine()->getManager();
            $videoFile = $form->get('url')->getData();
            /** @var UploadedFile $videoFile */
            if ($videoFile) {
                $originalFilename = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $videoFile->guessExtension();
                $videoFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
                $pub->setUrl($newFilename);
            }
            $em->persist($pub);
            $em->flush();
            return $this->redirectToRoute('DisplayPub');
        }
        return $this->render('publication/AddPub.html.twig',
            ['form'=>$form->createView()]);
    }


    /**
     * @param PublicationRepository $repo
     * @return Response
     * @Route ("/DisplayPub", name="DisplayPub")
     */
    public function DisplayvidForManager(PublicationRepository $repo)
    {
        $publication=$repo->findAll();
        return $this->render('publication/DisplayVid.html.twig',
            ['publication'=>$publication]);
    }
    /**
     * @param PublicationRepository $repo
     * @return Response
     * @Route ("/DisplayPubUser", name="DisplayPubUser")
     */
    public function DisplaypubForManager(PublicationRepository $repo)
    {
        $publication=$repo->findAll();
        return $this->render('publication/DisplayPub.html.twig',
            ['publication'=>$publication]);
    }

    /**
     * @param PublicationRepository $repo
     * @return Response
     * @Route ("/PlayVideo/{id}", name="PlayVideo")
     */
    public function DisplayvidByid(PublicationRepository $repo,$id)
    {
        $pub=$repo->findAll();
        $publication=$repo->find($id);
        return $this->render('publication/PlayVideo.html.twig',
            ['publication'=>$publication,'pub'=>$pub]);
    }


    /**
     * @param PublicationRepository $repo
     * @return Response
     * @Route ("/PlayVid/{id}", name="PlayVid")
     */
    public function DisplayvidManager(PublicationRepository $repo,$id)
    {
        $pub=$repo->findAll();
        $publication=$repo->find($id);
        return $this->render('publication/PlayVid.html.twig',
            ['publication'=>$publication,'pub'=>$pub]);
    }

    /**
     *@param Request $request
     * @return Response
     * @Route ("/UpdatePub/{id}", name="UpdatePub")
     */
    public function UpdatePub(PublicationRepository $repo,$id,Request $request)
    {
        $pub=$repo->find($id);
        $form=$this->createForm(PublicationType::class,$pub);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('DisplayPub');
        }
        return $this->render('publication/UpdatePub.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     * @param PublicationRepository $repo
     * @Route ("/DeletePub/{id}", name="DeletePub")
     */
    public function DeletePub($id,PublicationRepository $repo)
    {
        $pub=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($pub);
        $em->flush();
        return $this->redirectToRoute('DisplayPub');
    }
}
