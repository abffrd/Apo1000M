<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Form\AdoptantType;
use App\Repository\AdoptantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



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
     * @Route("/new", name="app_adoptant_new", methods={"GET", "POST"})
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
     * @Route("/{id}", name="app_adoptant_show", methods={"GET"})
     */
    public function show(Adoptant $adoptant): Response
    {
        return $this->render('adoptant/show.html.twig', [
            'adoptant' => $adoptant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_adoptant_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Adoptant $adoptant, AdoptantRepository $adoptantRepository): Response
    {
        $form = $this->createForm(AdoptantType::class, $adoptant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adoptantRepository->add($adoptant);
            return $this->redirectToRoute('app_adoptant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adoptant/edit.html.twig', [
            'adoptant' => $adoptant,
            'form' => $form,
        ]);
    }



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

    /**
     * @Route("/adoption_adoptant/{id}", name="create_adoption_adoptant", methods={"GET"})
     */
    public function create_adoption_adoptant(Adoptant $adoptant, AdoptantRepository $adoptantRepository): Response
    {
        dump('ici');

        $adoptant = $adoptantRepository->findOneByPhone($adoptant->getTelephone());

        // on vérifie si l'identifiant existe dans le tableau
        if ( is_null($adoptant))
        {
            // on jette une exception lorsque l'on rencontre une erreur
            // mais que l'on ne veut pas la gérer
            throw $this->createNotFoundException('The show does not exist');
            dump("l'adoptant n'existe pas");
        }

        dump("l'adoptant existe, on va lui créer un dossier");
        return $this->render('adoption/show.html.twig');
        
    
    }
}
