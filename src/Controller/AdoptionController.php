<?php

namespace App\Controller;

use App\Entity\Adoption;
use App\Entity\Adoptant;
use App\Entity\Animal;
use App\Form\AdoptionType;
use App\Repository\AdoptionRepository;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\New_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adoption")
 */
class AdoptionController extends AbstractController
{
    /**
     * @Route("/", name="app_adoption_index", methods={"GET"})
     */
    public function index(AdoptionRepository $adoptionRepository): Response
    {
        return $this->render('adoption/index.html.twig', [
            'adoptions' => $adoptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajout", name="app_adoption_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AdoptionRepository $adoptionRepository): Response
    {
        $adoption = new Adoption();
        $form = $this->createForm(AdoptionType::class, $adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adoptionRepository->add($adoption);
            return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adoption/new.html.twig', [
            'adoption' => $adoption,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_adoption_show", methods={"GET"})
     */
    public function show(Adoption $adoption): Response
    {
        return $this->render('adoption/show.html.twig', [
            'adoption' => $adoption,
        ]);
    }

    /**
     * @Route("/{id}/modification", name="app_adoption_edit", methods={"GET", "POST"})
     */
    public function edit( Request $request, Adoption $adoption, AdoptionRepository $adoptionRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdoptionType::class, $adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $adoptionRepository->add($adoption);
         
            return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->renderForm('adoption/edit.html.twig', [
            'adoption' => $adoption,
            'form' => $form,
        ]);
    }
    

    // TODO Gérer l'archivage
     /**
      * @Route("/{id}/archivage", name="app_adoption_delete", methods={"POST"})
      */
    /* public function delete(Request $request, Adoption $adoption, AdoptionRepository $adoptionRepository): Response
     {
         if ($this->isCsrfTokenValid('delete'.$adoption->getId(), $request->request->get('_token'))) {
             $adoptionRepository->remove($adoption);
         }

         return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);
     }*/

      /**
     * @Route("/{id}/sans_suite", name="app_adoption_disable", methods={"GET"})
     */
    public function sansSuite( Adoption $adoption, AdoptionRepository $adoptionRepository, EntityManagerInterface $entityManager): Response
    {
        $adoption->setStatut('dossier sans suite');
        $adoptionRepository->add($adoption);

            return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);
            
    }

    
    /**
     * @Route("/{id}/cr_complet", name="app_adoption_CR_complet", methods={"GET"})
     */
    public function CRComplet( Request $request, Adoption $adoption, AdoptionRepository $adoptionRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdoptionType::class, $adoption);
        $form->handleRequest($request);
     

        $adoption->setStatut('CR appel à valider');
        $adoptionRepository->add($adoption);
        return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);     
    }

    /**
     * @Route("/{id}/cr_accepte", name="app_adoption_CR_accepte", methods={"GET"})
     */
    public function CRAccepte(  Adoption $adoption, AdoptionRepository $adoptionRepository, EntityManagerInterface $entityManager): Response
    {
        $adoption->setStatut('animaux à proposer');
        $adoptionRepository->add($adoption);
        return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);     
    }
    
    /**
     * @Route("/{id}/affecter", name="app_adoption_affecter", methods={"GET"})
     */
    public function affecter(  Adoption $adoption, AdoptionRepository $adoptionRepository, EntityManagerInterface $entityManager): Response
    {
        
        $adoption->setStatut('CR appel à faire');
        $adoptionRepository->add($adoption);
        return $this->redirectToRoute('app_adoption_index', [], Response::HTTP_SEE_OTHER);     
    }
}