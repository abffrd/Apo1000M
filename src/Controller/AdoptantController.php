<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Form\AdoptantType;
use App\Repository\AdoptantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



/**
 * @Route("/adoptant")
 */
class AdoptantController extends AbstractController
{
    /**
     * @Route("/", name="app_adoptant_index", methods={"GET"})
     */
    public function index(AdoptantRepository $adoptantRepository): Response
    {
        return $this->render('adoptant/index.html.twig', [
            'adoptants' => $adoptantRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_RESPONSABLE_POLE")
     * @Route("/ajout", name="app_adoptant_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AdoptantRepository $adoptantRepository): Response
    {
        $adoptant = new Adoptant();
        $form = $this->createForm(AdoptantType::class, $adoptant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adoptantRepository->add($adoptant);
            return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adoptant/new.html.twig', [
            'adoptant' => $adoptant,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_RESPONSABLE_POLE")
     * @Route("/{id}", name="app_adoptant_show", methods={"GET"})
     */
    public function show(Adoptant $adoptant): Response
    {
        return $this->render('adoptant/show.html.twig', [
            'adoptant' => $adoptant,
        ]);
    }

    /**
     * @Route("/{id}/modification", name="app_adoptant_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Adoptant $adoptant, AdoptantRepository $adoptantRepository): Response
    {
        $form = $this->createForm(AdoptantType::class, $adoptant);
        $form->handleRequest($request);
        $retour = ($_SERVER['HTTP_REFERER']);
        //dd($retour); // "http://localhost:8000/adoption/302/modification"

        $id = 302;
        if ($form->isSubmitted() && $form->isValid()) {
           
            $adoptantRepository->add($adoptant);
            //dd($_SERVER['HTTP_REFERER']); // "http://localhost:8000/adoptant/335/modification"
            //return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
            //TODO redirection vers la page adoption si on en vient
             //header('Location: http://localhost:8000/adoption/' . $id . '/modification');
             header ('Location: ' . $_SERVER['HTTP_REFERER']);

            exit();
 
        }

        return $this->renderForm('adoptant/edit.html.twig', [
            'adoptant' => $adoptant,
            'form' => $form,
        ]);
    }

//     <?php
//     header('Location: http://www.votresite.com/pageprotegee.php');
//     exit();
//

    // TODO Gérer l'archivage
    /**
     * @Route("/{id}", name="app_adoptant_delete", methods={"POST"})
     */
    /* public function delete(Request $request, Adoptant $adoptant, AdoptantRepository $adoptantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adoptant->getId(), $request->request->get('_token'))) {
            $adoptantRepository->remove($adoptant);
        }

        return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
    } */

}
