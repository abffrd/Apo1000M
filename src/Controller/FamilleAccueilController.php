<?php

namespace App\Controller;

use App\Entity\FamilleAccueil;
use App\Form\FamilleAccueilType;
use App\Repository\FamilleAccueilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/famille_accueil")
 */
class FamilleAccueilController extends AbstractController
{
    /**
     * @Route("/", name="app_famille_accueil_index", methods={"GET"})
     */
    public function index(FamilleAccueilRepository $familleAccueilRepository): Response
    {
        return $this->render('famille_accueil/index.html.twig', [
            'famille_accueils' => $familleAccueilRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajout", name="app_famille_accueil_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FamilleAccueilRepository $familleAccueilRepository): Response
    {
        $familleAccueil = new FamilleAccueil();
        $form = $this->createForm(FamilleAccueilType::class, $familleAccueil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $familleAccueilRepository->add($familleAccueil);
            return $this->redirectToRoute('app_famille_accueil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('famille_accueil/new.html.twig', [
            'famille_accueil' => $familleAccueil,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_famille_accueil_show", methods={"GET"})
     */
    public function show(FamilleAccueil $familleAccueil): Response
    {
        return $this->render('famille_accueil/show.html.twig', [
            'famille_accueil' => $familleAccueil,
        ]);
    }

    /**
     * @Route("/{id}/modification", name="app_famille_accueil_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FamilleAccueil $familleAccueil, FamilleAccueilRepository $familleAccueilRepository): Response
    {
        $form = $this->createForm(FamilleAccueilType::class, $familleAccueil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $familleAccueilRepository->add($familleAccueil);
            return $this->redirectToRoute('app_famille_accueil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('famille_accueil/edit.html.twig', [
            'famille_accueil' => $familleAccueil,
            'form' => $form,
        ]);
    }

    // TODO Gérer l'archivage
    /**
     * @Route("/{id}", name="app_famille_accueil_delete", methods={"POST"})
     */
    /*public function delete(Request $request, FamilleAccueil $familleAccueil, FamilleAccueilRepository $familleAccueilRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$familleAccueil->getId(), $request->request->get('_token'))) {
            $familleAccueilRepository->remove($familleAccueil);
        }

        return $this->redirectToRoute('app_famille_accueil_index', [], Response::HTTP_SEE_OTHER);
    }*/
}
