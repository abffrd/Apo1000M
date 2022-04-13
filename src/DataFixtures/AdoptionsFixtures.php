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
use App\Entity\Role;
use App\Entity\User;
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
            $famille->setTelephone($faker->numberBetween(600000000, 799999999));
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
            $adoption->setStatut('000');


            $statutObjects  =['000', '010','020','030','040','050'];
            $randomIndex = array_rand($statutObjects);
            $adoption->setStatut($statutObjects[$randomIndex]);


            //récupérer l'adoptant fixturisé
                /*$randomIndex = array_rand($adoptantsObjects);
                $adoption->setAdoptant($adoptantsObjects[$randomIndex]);*/


            $adoption->setAnimauxProposes('les animaux proposes sont...');

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
            $adoptant->setTelephone(($faker->numberBetween(600000000, 799999999)));
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
            'ROLE_USER',
            'ROLE_BENEVOLE',
            'ROLE_RESPONSABLE_POLE',
            'ROLE_MEMBRE_BUREAU',
            'ROLE_ADMIN' ,
        ];

        $roleObjects = [];

        foreach ($roles as $currentRole) {
            $role = new Role();
            $role->setRole($currentRole);

            $roleObjects[] = $role;
            $manager->persist($role);

        }





         // crétion de l'utilsateur
         $user = new User();
         $user->setEmail('admin@moustache.fr');
         $user->setNom('Admin');
         $user->setPrenom('Moustaches');
         // password is moustache
         $user->setPassword('$2y$13$g4Cs8r5IPAQJX/ndeMYzQudyUgqEzHU1euGcasWl32mdI5/g6GA8y');
         $user->setRoles(['ROLE_ADMIN']);
         $user->setActif('1');
         $manager->persist($user);
 
         $user = new User();
         $user->setEmail('membre@moustache.fr');
         $user->setNom('Membre de bureau');
         $user->setPrenom('Moustaches');
         // password is moustache
         $user->setPassword('$2y$13$g4Cs8r5IPAQJX/ndeMYzQudyUgqEzHU1euGcasWl32mdI5/g6GA8y');
         $user->setRoles(['ROLE_MEMBRE_BUREAU']);
         $user->setActif('1');
         $manager->persist($user);
         
         $user = new User();
         $user->setEmail('responsable@moustache.fr');
         $user->setNom('Responsable Pôle');
         $user->setPrenom('Moustaches');
         // password is moustache
         $user->setPassword('$2y$13$g4Cs8r5IPAQJX/ndeMYzQudyUgqEzHU1euGcasWl32mdI5/g6GA8y');
         $user->setRoles(['ROLE_RESPONSABLE_POLE']);
         $user->setActif('1');
         $manager->persist($user);
 
 
         $user = new User();
         $user->setEmail('benevole@moustache.fr');
         $user->setNom('Bénévole');
         $user->setPrenom('Moustaches');
         // password is moustache
         $user->setPassword('$2y$13$g4Cs8r5IPAQJX/ndeMYzQudyUgqEzHU1euGcasWl32mdI5/g6GA8y');
         $user->setRoles(['ROLE_BENEVOLE']);
         $user->setActif('1');
         $manager->persist($user);
 
         $user = new User();
         $user->setEmail('user@moustache.fr');
         $user->setNom('User');
         $user->setPrenom('Moustaches');
         // password is moustache
         $user->setPassword('$2y$13$g4Cs8r5IPAQJX/ndeMYzQudyUgqEzHU1euGcasWl32mdI5/g6GA8y');
         $user->setRoles(['ROLE_USER']);
         $user->setActif('1');
         $manager->persist($user);

         

        $manager->flush();

        //commande pour lancer les fixtures
        //php bin/console doctrine:fixtures:load
    }
}
