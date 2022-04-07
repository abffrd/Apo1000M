<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Adoption;
use App\Entity\Adoptant;
use App\Entity\Animal;
use App\Entity\Espece;
use App\Entity\FamilleAccueil;
use App\Entity\User;
use App\Entity\Role;
use DateTime;

class AdoptionsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();


        // créer une liste de genre et les stocker dans un tableau
        $especes = [
            'chat',
            'chien',
            'lapin',
            'chon',
            'octodon',
            'poule',
        ];

        // va contenir les objets genre que l'on a créé
        $especeObjects = [];

        foreach ($especes as $currentEspece) {
            $espece = new Espece();
            $espece->setType($currentEspece);

            // dire à Doctrine de gérer le nouvel objet
            $especeObjects[] = $espece;
            $manager->persist($espece);
        }

        //création des fixtures pour les familles d'accueil
        $nbfamilles = 10;
        $familleObjects = [];
        for ($i = 0; $i < $nbfamilles; $i++) {
            $famille = new FamilleAccueil();
            $famille->setNom($faker->lastName());
            $famille->setPrenom($faker->firstName());
            $famille->setAdresse($faker->streetAddress());
            $famille->setTelephone($faker->phoneNumber());
            $famille->setEmail($faker->email());
            $famille->setVille($faker->city());
            $famille->setCodePostal($faker->numberBetween(44000,44999));
            $famille->setCommentaire($faker->sentence());  

            //TODO relation one to many --> à améliorer en many to many
            $randomIndex = array_rand($especeObjects);
            $famille->addEspece($especeObjects[$randomIndex]);
            // ajouter les associations avec Genre
            /*for ($i = 0; $i <= rand(1, 2) ; $i++)
            {
                $randomIndex = array_rand($especeObjects);
                $famille->addEspece($especeObjects[$randomIndex]);
            }*/

        // dire à Doctrine de gérer le nouvel objet
        $familleObjects[] = $famille;
        $manager->persist($famille);
        }


        //création des fixtures pour les animaux
        $nbAnimaux = 10;
        $animauxObjects = [];
        for ($i = 0; $i < $nbAnimaux; $i++) {
            $animal = new Animal();
            $animal->setNom($faker->lastName());
            $animal->setDateNaissance($faker->dateTime());
            $animal->setStatut($faker->word());
            $animal->setTests($faker->word());

                $sexe =[
                    'inconnu', 'male','femelle',];
                $sexeIndex = rand(0, 2);
            $animal->setSexe($sexe[$sexeIndex]);
                $vaccins =[
                'ok', 'primo à faire' , 'rappel à faire'];
                $vaccinIndex = rand(0, 2);
            $animal->setVaccins($vaccins[$vaccinIndex]);
            $animal->setPhoto('https://picsum.photos/id/' . ( $i + 1 ) . '/200/300');
            $animal->setCommentaire($faker->sentence());         
            $animal->setIdentification($faker->word());  
                $sterilise=['oui', 'non'];
                $sterIndex = rand(0, 1);
            $animal->setSterilise($sterilise[$sterIndex]);

            //récupérer la famille d'accueil fixturisée
                $randomIndex = array_rand($familleObjects);
            $animal->setFamilleAccueil($familleObjects[$randomIndex]);    

            //récupérer l'espèce fixturisée
                $randomIndex = array_rand($especeObjects);
            $animal->setEspece($especeObjects[$randomIndex]);   

            // dire à Doctrine de gérer le nouvel objet
            $animauxObjects[] = $animal;
            $manager->persist($animal);
        }



        //Création des fixtures pour les adoptions
        $nbAdptions = 10;
        $adoptionObjects = [];
        for ($i = 0; $i < $nbAdptions; $i++) {
            $adoption = new Adoption();
            $adoption->setDateAppel(new DateTime());
            $adoption->setCompteRendu($faker->sentence());
            $adoption->setRetourAnimauxProposes($faker->sentence());
            $adoption->setDateRencontre(new DateTime());
            $adoption->setRetourRencontreAdoptant($faker->sentence());
            $adoption->setRetourRencontreFa($faker->sentence());
            $adoption->setDateVisite(new DateTime());
            $adoption->setRetourVisite($faker->sentence());
            $adoption->setDateAdoption(new DateTime());
            $adoption->setDateDepart(new DateTime());
            $adoption->setRemarque($faker->sentence());
            //TODO : mettre le statut en liste
            $adoption->setStatut('statut');

            //récupérer l'adoptant fixturisé
                /*$randomIndex = array_rand($adoptantsObjects);
                $adoption->setAdoptant($adoptantsObjects[$randomIndex]);*/

            //TODO : ajouter les membres qui s'occupent du dossier
            //!$adoption->addMembre

            $adoption->setAnimauxProposes('les animaux proposes sont...');

            //TODO relation one to many --> à améliorer en many to many
            $randomIndex = array_rand($animauxObjects);
            $adoption->addAnimal($animauxObjects[$randomIndex]);

            // dire à Doctrine de gérer le nouvel objet
            $adoptionObjects[] = $adoption;
            $manager->persist($adoption);
        }

        //création des fixtures pour les adoptants
        $nbAdoptants = 10;
        $adoptantsObjects = [];
        for ($i = 0; $i < $nbAdoptants; $i++) {
            $adoptant = new Adoptant();
            $adoptant->setNom($faker->lastName());
            $adoptant->setPrenom($faker->firstName());
            $adoptant->setAdresse($faker->streetAddress());
            $adoptant->setTelephone($faker->phoneNumber());
            $adoptant->setEmail($faker->email());
            $adoptant->setVille($faker->city());
            $adoptant->setCodePostal($faker->numberBetween(44000,44999));
            //TODO relation one to many --> à améliorer en many to many
            $randomIndex = array_rand($adoptionObjects);
            $adoptant->addAdoption($adoptionObjects[$randomIndex]);

            // dire à Doctrine de gérer le nouvel objet
            $adoptantsObjects[] = $adoptant;
            $manager->persist($adoptant);
        }

        //Création des fixtures pour les roles
        $roles = [
            'ROLE_ADMIN',
            'RESPONSABLE_POLE',
            'ROLE_USER',
            'DEFAULT_ROLE',
        ];

        $roleObjects = [];

        foreach ($roles as $currentRole) {
            $role = new Role();
            $role->setRole($currentRole);

            $roleObjects[] = $role;
            $manager->persist($role);

        }


        //Création des fixtures pour les membres
        $nbMembres = 20;
        $membresObjects = [];
        for ($i = 0; $i < $nbMembres; $i++){
            $membre = new User();
            $membre->setNom($faker->lastName());
            $membre->setPrenom($faker->firstNAme());
            $membre->setPassword($faker->password());
            $membre->setEmail($faker->email());
            $membre->setActif($faker->numberBetween(0, 1));

            //TODO relation one to many --> à améliorer en many to many
            //$randomIndex = array_rand($roleObjects);
            //$membre->setRoles($roleObjects[$randomIndex]);

            //TODO relation one to many --> à améliorer en many to many
            $randomIndex = array_rand($adoptionObjects);
            $membre->addAdoption($adoptionObjects[$randomIndex]);

            $membresObjects[] = $membre;
            $manager->persist($membre);

        }

        $manager->flush();
    }
}
