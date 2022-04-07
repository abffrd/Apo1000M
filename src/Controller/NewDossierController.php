<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Repository\AdoptantRepository;
use App\Entity\Adoption;
use App\Repository\AdoptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/new_dossier")
 */

class NewDossierController extends AbstractController
{
    /**
     * @Route("/", name="app_new_dossier")
     */
    public function index(): Response
    {
        return $this->render('adoption/new_dossier.html.twig', [
            'controller_name' => 'NewDossierController',
        ]);
    }

    /**
     * @Route("/{telephone}/adoption_adoptant", name="create_adoption_adoptant", methods={"GET"})
     */
    public function create_adoption_adoptant(Adoptant $adoptant, AdoptantRepository $adoptantRepository, EntityManagerInterface $entityManager): Response
    {
        dump('ici');
        // on regarde si le n0 de téléphone est dans la table adoptant
        $adoptant = $adoptantRepository->findOneByPhone($adoptant->getTelephone());

        // on vérifie si l'identifiant existe dans le tableau
        if ($adoptant === null)
        {   // s'il n'y est pas on crée un adoptant avec ce n° de telephone
            // truc genre $adoptant = new adoptant....

            // puis on créé une adoption avec cet adoptant
            // truc genre $adoption = new adoption....

            return $this->render('main/login.html.twig');
            //throw $this->createNotFoundException('Utilisateur non trouvé(e).');  
        }

        //sinon, l'adoptant existe, on lui crée une adoption
        dump($adoptant);
        $adoption = new Adoption;

        $adoption->setAdoptant($adoptant); 
        dump($adoption);
        $entityManager->persist($adoption);
        $entityManager->flush();
        //new adoption avec adoptant = id --> 283
        $this->addFlash('success', 'Ajout effectué');
        return $this->redirectToRoute('app_new_dossier', [], Response::HTTP_SEE_OTHER);

    }
}
