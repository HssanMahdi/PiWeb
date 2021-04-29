<?php

namespace App\Controller;

use App\Entity\Statistique;
use App\Form\StatistiqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/statistique")
 */
class StatistiqueController extends AbstractController
{
    /**
     * @Route("/", name="statistique_index", methods={"GET"})
     */
    public function index(): Response
    {
        $statistiques = $this->getDoctrine()
            ->getRepository(Statistique::class)
            ->findAll();

        return $this->render('statistique/index.html.twig', [
            'statistiques' => $statistiques,
        ]);
    }

    /**
     * @Route("/new", name="statistique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $statistique = new Statistique();
        $form = $this->createForm(StatistiqueType::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statistique);
            $entityManager->flush();

            return $this->redirectToRoute('statistique_index');
        }

        return $this->render('statistique/new.html.twig', [
            'statistique' => $statistique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idStatistique}", name="statistique_show", methods={"GET"})
     */
    public function show(Statistique $statistique): Response
    {
        return $this->render('statistique/show.html.twig', [
            'statistique' => $statistique,
        ]);
    }

    /**
     * @Route("/{idStatistique}/edit", name="statistique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Statistique $statistique): Response
    {
        $form = $this->createForm(StatistiqueType::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('statistique_index');
        }

        return $this->render('statistique/edit.html.twig', [
            'statistique' => $statistique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idStatistique}", name="statistique_delete", methods={"POST"})
     */
    public function delete(Request $request, Statistique $statistique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statistique->getIdStatistique(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($statistique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('statistique_index');
    }
}
