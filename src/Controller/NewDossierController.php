<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Repository\AdoptantRepository;
use App\Entity\Adoption;
use App\Repository\AdoptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/new_dossier")
 */

class NewDossierController extends AbstractController
{
    /**
     * @Route("/", name="app_new_dossier", methods={"GET", "POST"})
     */
    public function index(AdoptantRepository $adoptantRepository,EntityManagerInterface $entityManager): Response
    {
       

        if ( isset( $_GET['submit'] ) ) {
            /* récupérer les données du formulaire en utilisant 
            la valeur des attributs name comme clé 
            */
            $telephone = $_GET['phone']; 
            //var_dump($telephone);die();

            
        

            //! étape 1 on cherche si le numéro de tel est déjà dans la base
      
            $adoptant = $adoptantRepository->findOneByPhone($telephone);
             
            //! étape 2a, le numéro n'est pas dans la base
                // 2a1 on crée le nouvel adoptant
            if(!$adoptant){
                
                $adoptant = new Adoptant;
                // $adoptant->setNom('bob');
                // $adoptant->setPrenom('garner');
                $adoptant->setTelephone($telephone);
                $entityManager->persist($adoptant);
                $entityManager->flush();
    


                }

           
             // dd($adoptant);

                //! 2b2 on lui crée un adoption --> redirige vers create_adoption_adoptant

                //! etape 2b le numéro est dans la base --> redirige vers create_adoption_adoptant
                
                return $this->redirectToRoute('create_adoption_adoptant', ['telephone' => $telephone]);
                

        }


        return $this->render('adoption/new_dossier.html.twig', [
            'controller_name' => 'NewDossierController',
        ]);
    }

    /**
    * @Route("/{telephone}/adoption_adoptant", name="create_adoption_adoptant", methods={"GET"})
    */
     public function create_adoption_adoptant(Adoptant $adoptant, AdoptantRepository $adoptantRepository, EntityManagerInterface $entityManager): Response
    {
        //dd('ici');
        // on regarde si le n0 de téléphone est dans la table adoptant
        $adoptant = $adoptantRepository->findOneByPhone($adoptant->getTelephone());

        // on vérifie si l'identifiant existe dans le tableau
        /* if ($adoptant === null)
        {   // s'il n'y est pas on crée un adoptant avec ce n° de telephone
            // truc genre $adoptant = new adoptant....
            dd("pas d'adoptant");
            // puis on créé une adoption avec cet adoptant
            // truc genre $adoption = new adoption....

            return $this->render('main/login.html.twig');
            //throw $this->createNotFoundException('Utilisateur non trouvé(e).');  
        } */

        //sinon, l'adoptant existe, on lui crée une adoption
        $adoption = new Adoption;
        
        $adoption->setAdoptant($adoptant); 
        $adoption->setStatut('000');
        
        $entityManager->persist($adoption);
        $entityManager->flush();
        //dump($adoption);die();
        //new adoption avec adoptant = id --> 283
        $this->addFlash('success', 'Ajout effectué');
        return $this->redirectToRoute('app_new_dossier', [], Response::HTTP_SEE_OTHER); 

    } 
}
