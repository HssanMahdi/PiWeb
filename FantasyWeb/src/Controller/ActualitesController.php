<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Form\ActualitesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


/**
 * @Route("/actualites")
 */
class ActualitesController extends AbstractController
{
    /**
     * @Route("/", name="actualites_index", methods={"GET"})
     */
    public function index(): Response
    {
        $actualites = $this->getDoctrine()
            ->getRepository(Actualites::class)
            ->findAll();

        return $this->render('actualites/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    /**
     * @Route("/new", name="actualites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $actualite = new Actualites();
        $form = $this->createForm(ActualitesType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actualite);
            $entityManager->flush();

            return $this->redirectToRoute('actualites_index');
        }

        return $this->render('actualites/new.html.twig', [
            'actualite' => $actualite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idActualites}", name="actualites_show", methods={"GET"})
     */
    public function show(Actualites $actualite): Response
    {
        return $this->render('actualites/show.html.twig', [
            'actualite' => $actualite,
        ]);
    }

    /**
     * @Route("/{idActualites}/edit", name="actualites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actualites $actualite): Response
    {
        $form = $this->createForm(ActualitesType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actualites_index');
        }

        return $this->render('actualites/edit.html.twig', [
            'actualite' => $actualite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idActualites}", name="actualites_delete", methods={"POST"})
     */
    public function delete(Request $request, Actualites $actualite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actualite->getIdActualites(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actualite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('actualites_index');
    }

    /**
     * @param Request $request
     * @param NormalizerInterface $Normalizer
     * @Route("/searchStudentx ", name="searchStudentx")
     * @return Response

     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function searchActualites(Request $request,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        $requestString=$request->get('searchValue');
        $act= $repository->findactualite($requestString);
        $jsonContent = $Normalizer->normalize($act, 'json',['groups'=>'act:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }







}
