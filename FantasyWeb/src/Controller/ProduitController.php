<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Twilio\Rest\Client;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(Request $request , PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        $produits = $paginator->paginate(

            $donnees,
            $request->query->getInt('page',1),
            2
        );

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    /**
    * @Route("/prod", name="prod", methods={"GET"})
    */

    public function ProduitTest() {
       $produits = $this->getDoctrine()
           ->getRepository(Produit::class)
           ->findAll();
      return $this->render('produit/DisplayProduct.html.twig', [
           'produits' => $produits,
       ]);
   }

    /**
     * @Route("/calender", name="calender", methods={"GET"})
     */

    public function calender() {

        return $this->render('produit/calender.html.twig', []);
    }


    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $produit->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory1'),
                    $fileName
                );
            } catch (FileException $e) {

                // ... handle exception if something happ

            }

            $produit->setImage($fileName);



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();
//            $sid = "ACbfa5c0910447c592cfd57947c59e4bb0"; // Your Account SID from www.twilio.com/console
//            $token = "ca434da7f88ac5fbedb7c0799f6bc8f7"; // Your Auth Token from www.twilio.com/console
//
//            $client = new Client($sid, $token);
//
//            $message = $client->messages->create(
//
//                '+21699399444', // Text this number
//                [
//                    'from' => '+15168530244', // From a valid Twilio number
//                    'body' => 'nouveau produit ajouter :'.$produit->getNomProduit()
//                ]
//            );
            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idProduit}", name="produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }



    /**
     * @Route("/{idProduit}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {


        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $produit->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory1'),
                    $fileName
                );
            } catch (FileException $e) {

                // ... handle exception if something happ

            }

            $produit->setImage($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idProduit}", name="produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdProduit(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }

    /**
     * @Route("/p/produit_stat", name="produit_stat", methods={"GET"})
     */
    public function reclamation_stat(ProduitRepository $ProduitRepository): Response
    {
        $nbrs[]=Array();

        $e1=$ProduitRepository->find_sat_cat("sport equipement");

        $nbrs[]=$e1[0][1];
        $e2=$ProduitRepository->find_sat_cat("sport shirts");

        $nbrs[]=$e2[0][1];

        $e3=$ProduitRepository->find_sat_cat("workouts");

        $nbrs[]=$e3[0][1];

        $e4=$ProduitRepository->find_sat_cat("gym material");

        $nbrs[]=$e4[0][1];



        reset($nbrs);

        $key = key($nbrs);


        unset($nbrs[$key]);

        $nbrss=array_values($nbrs);
        //  dump(json_encode($nbrss));

        return $this->render('produit/stat.html.twig', [
            'nbr' => json_encode($nbrss),
        ]);
    }

    /**
     * @Route("/p/search_produit", name="search_produit", methods={"GET"})
     */
    public function search_produit(Request $request,NormalizerInterface $Normalizer,ProduitRepository $ProduitRepository ): Response
    {

        $requestString=$request->get('searchValue');
        $requestString2=$request->get('searchValue2');


        //   dump($requestString);
        //  dump($requestString2);
        $produits = $ProduitRepository->findProduitsBySujet($requestString,$requestString2);
        //   dump($reclamations);
        $jsoncontentc =$Normalizer->normalize($produits,'json',['groups'=>'posts:read']);
        //  dump($jsoncontentc);
        $jsonc=json_encode($jsoncontentc);
        //   dump($jsonc);
        if(  $jsonc == "[]" )
        {
            return new Response(null);
        }
        else{        return new Response($jsonc);
        }

    }
}
