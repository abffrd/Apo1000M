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

        //$faker = Factory::create();
        //fixtures en français
        $faker = Factory::create('fr_FR');


        // créer une liste de genre et les stocker dans un tableau
        $especes = [
            'chat',
            'chien',
            'lapin',
            'cochon d inde',
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

        $luna = [
            'nom' => 'Luna',
            $date = new \DateTime('11/05/2009'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => 'FELV - et FIV -' ,
            'sexe' => 'féminin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/04/Luna-3-900x550.jpg.webp',
            'commentaire' => "Chat astral qui illumine une pièce rien que par sa présence. Voilà une description plutôt sympa.",
            'identification' => 'HCV852',
            'sterilise' => '1', 
        ];
        $animaux[] = $luna;

        $austin = [
            'nom' => 'Austin',
            $date = new \DateTime('01/01/2018'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => '-' ,
            'sexe' => 'masculin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/04/275607021_10166122831880634_1459553801026917215_n-300x300.jpg.webp',
            'commentaire' => "Je suis très affectueux et sociable avec les humains, que ce soit homme, femme ou enfant. Je vais très facilement vers les gens. Très affectueux, gentil et un brin pot de colle j’adore les caresses, les grattouilles et me nicher dans vos bras.",
            'identification' => '250 26 87 43 87 41 12',
            'sterilise' => '1', 
        ];
        $animaux[] = $austin;

        $ressa = [
            'nom' => 'Ressa',
            $date = new \DateTime('01/07/2021'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => 'FELV - et FIV -' ,
            'sexe' => 'féminin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/04/Nouveau-projet12-700x550.jpg.webp',
            'commentaire' => "une chaise ou un griffoir en carton me font des couches paisibles. Des jouets ? Bah, ça m’intéresse pas vraiment, c’est qu’entre mes récits, mes siestes et mes repas, j’ai pas vraiment le temps de m’y consacrer. Une vraie chatte d’écrivain en somme !",
            'identification' => '250 26 95 90 72 07 94',
            'sterilise' => '1', 
        ];
        $animaux[] = $ressa;

        $sheeran = [
            'nom' => 'Sheeran',
            $date = new \DateTime('01/01/2019'),
            'datedenaissance' => $date,
            'statut' => 'non adoptable' ,
            'tests' => 'FELV - et FIV -' ,
            'sexe' => 'masculin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/03/Nouveau-projet12-2-600x600.jpg.webp',
            'commentaire' => "Voilà, je suis donc à la recherche d’une famille pas trop pot de colle, absolument sans enfants. Une famille en maison avec un super canapé douillet et un grand jardin pour me maintenir en forme. Timide mais sociable, j’accepte tout autre pote moustachu.e",
            'identification' => '250268743874459',
            'sterilise' => '1', 
        ];
        $animaux[] = $sheeran;

        $tesla = [
            'nom' => 'Tesla',
            $date = new \DateTime('01/01/2020'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => 'FELV - et FIV -' ,
            'sexe' => 'féminin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/02/Tesla-4-300x300.jpg.webp',
            'commentaire' => "Je suis un chat encore un peu craintif, mais je suis très gentil et plein de douceur. J’aime les caresses surtout celles sous le menton, les joues et entre les oreilles ; c’est tellement agréable !!!",
            'identification' => '250268743874459',
            'sterilise' => '1', 
        ];
        $animaux[] = $tesla;

        $titi = [
            'nom' => 'Titi',
            $date = new \DateTime('08/09/2020'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => 'FELV - et FIV -' ,
            'sexe' => 'féminin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/03/Titi-2-900x550.jpg.webp',
            'commentaire' => "J’ai été pris en charge récemment par les Moustachus mais avant ça, j’habitais dans le jardin d’une gentille dame qui me nourrissait régulièrement. Maintenant, j’attends de trouver une famille",
            'identification' => '250 26 95 90 74 00 72',
            'sterilise' => '1', 
        ];
        $animaux[] = $titi;

        $hope = [
            'nom' => 'Hope',
            $date = new \DateTime('01/09/2020'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => '-' ,
            'sexe' => 'féminin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2021/05/Hope-11.10-300x300.jpg.webp',
            'commentaire' => "La bouffe, c’est vraiment mon truc. En plus, j’aime tout ! Par contre, si ça ne vient pas assez vite, je viendrai vous gratter le mollet des fois que vous m’auriez oubliée. Mais quand vous m’aurez servi mon repas, je l’emmènerai où bon me semble.",
            'identification' => '',
            'sterilise' => '1', 
        ];
        $animaux[] = $hope;

        $penelope = [
            'nom' => 'Pénélope',
            $date = new \DateTime('01/08/2020'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => '-' ,
            'sexe' => 'féminin',
            'vaccins' => 'pas besoin',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2021/05/Penelope-3-620x550.jpg.webp',
            'commentaire' => "Je serai ravie de faire partie de votre vie. Cependant, il faudra avant toute chose, apprivoiser la jolie petite boule de poids que je suis. Oups lapsus ! Il est vrai qu’ayant eu des mini-moi il y a peu, j’ai encore quelques rondeurs à perdre !",
            'identification' => 'pas besoin',
            'sterilise' => '0', 
        ];
        $animaux[] = $penelope;

        $rex = [
            'nom' => 'Rex',
            $date = new \DateTime('09/03/2021'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => '' ,
            'sexe' => 'masculin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/03/Rex-3-300x300.jpg.webp',
            'commentaire' => "Hello ! Moi c’est Rex, jeune chien croisé épagneul et malinois, ce qui fait de moi un compagnon rempli d’énergie et d’amour. Je ne veux pas paraître prétentieux mais je suis beau, intelligent, curieux, joueur et un poil collant. ",
            'identification' => '250 26 85 02 08 14 01',
            'sterilise' => '1', 
        ];
        $animaux[] = $rex;
 
        $fizzy = [
            'nom' => 'Fizzy',
            $date = new \DateTime('09/03/2021'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => 'FELV - et FIV -' ,
            'sexe' => 'masculin',
            'vaccins' => 'ok',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2022/04/Fizzi-800x550.jpg.webp',
            'commentaire' => "Bonjour, moi c’est Fizzi, digne papy Persan ! Malgré mon Pedigree de chat Persan, ma royale existence n’a pas été dorée. J’ai vécu à la Cendrillon pendant 12 ans, avec mes dignes compagnons d’infortune, avant qu’une bonne fée ne vienne nous sauver.",
            'identification' => '250 26 85 02 08 14 01',
            'sterilise' => '1', 
        ];
        $animaux[] = $fizzy;   
 
        $lima = [
            'nom' => 'Lima',
            $date = new \DateTime('01/08/2020'),
            'datedenaissance' => $date,
            'statut' => 'adoptable' ,
            'tests' => '-' ,
            'sexe' => 'féminin',
            'vaccins' => '-',
            'photo' => 'https://www.1000moustaches.fr/wp-content/uploads/2021/05/Lima-3-562x550.jpg.webp',
            'commentaire' => "Mignonne et maligne LIMA. ma coloc et moi avons décidé de nous séparer cause bagarre entre nanas. Le fait est que, j’ai décidé de me réorienter dans le renseignement des brins de foin où, mon prénom colle déjà parfaitement.",
            'identification' => '250 26 85 02 08 14 01',
            'sterilise' => '1', 
        ];
        $animaux[] = $lima;     

        foreach ($animaux as $currentanimal) {
            $animal = new Animal();
            $animal->setNom($currentanimal['nom']);
            $animal->setDateNaissance($currentanimal['datedenaissance']);
            $animal->setStatut($currentanimal['statut']);
            $animal->setTests($currentanimal['tests']);
            $animal->setSexe($currentanimal['sexe']);
            $animal->setVaccins($currentanimal['vaccins']);
            $animal->setPhoto($currentanimal['photo']);
            $animal->setCommentaire($currentanimal['commentaire']);        
            $animal->setIdentification($currentanimal['identification']); 
            $animal->setSterilise($currentanimal['sterilise']);
            //récupérer l'espèce fixturisée
            $randomIndex = array_rand($especeObjects);
            $animal->setEspece($especeObjects[$randomIndex]); 
            $manager->persist($animal);
        }

        //création des fixtures pour les adoptants
        $nbAdoptants = 5;
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

            $adoptantsObjects[] = $adoptant;
            $manager->persist($adoptant);
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

            $statutObjects  =['à prendre', 'CR appel à faire'];
            $randomIndex = array_rand($statutObjects);
            $adoption->setStatut($statutObjects[$randomIndex]);

            //récupérer l'adoptant fixturisé
            $randomIndex = array_rand($adoptantsObjects);
            $adoption->setAdoptant($adoptantsObjects[$randomIndex]);

            $adoption->setAnimauxProposes('les animaux proposes sont...');


            // dire à Doctrine de gérer le nouvel objet
            $adoptionObjects[] = $adoption;
            $manager->persist($adoption);
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

         // création de l'utilsateur
         $user = new User();
         $user->setEmail('admin@moustache.fr');
         $user->setNom('Admin');
         $user->setPrenom('Alice');
         // password is moustache
         $user->setPassword('$2y$13$KospP1ZKp5NS8aIyftCu3.RhAfM7/hFv5jv4S85fTOVxgFuFm7qRq');
         $user->setRoles(['ROLE_ADMIN']);
         $user->setActif('1');
         $manager->persist($user);
 
         $user = new User();
         $user->setEmail('membre@moustache.fr');
         $user->setNom('Membre de bureau');
         $user->setPrenom('Alaric');
         // password is moustache
         $user->setPassword('$2y$13$KospP1ZKp5NS8aIyftCu3.RhAfM7/hFv5jv4S85fTOVxgFuFm7qRq');
         $user->setRoles(['ROLE_MEMBRE_BUREAU']);
         $user->setActif('1');
         $manager->persist($user);
         
         $user = new User();
         $user->setEmail('responsable@moustache.fr');
         $user->setNom('Responsable Pôle');
         $user->setPrenom('Muthu');
         // password is moustache
         $user->setPassword('$2y$13$KospP1ZKp5NS8aIyftCu3.RhAfM7/hFv5jv4S85fTOVxgFuFm7qRq');
         $user->setRoles(['ROLE_RESPONSABLE_POLE']);
         $user->setActif('1');
         $manager->persist($user);
 
         $user = new User();
         $user->setEmail('benevole@moustache.fr');
         $user->setNom('Bénévole');
         $user->setPrenom('Vincent');
         // password is moustache
         $user->setPassword('$2y$13$KospP1ZKp5NS8aIyftCu3.RhAfM7/hFv5jv4S85fTOVxgFuFm7qRq');
         $user->setRoles(['ROLE_BENEVOLE']);
         $user->setActif('1');
         $manager->persist($user);
 
         $user = new User();
         $user->setEmail('user@moustache.fr');
         $user->setNom('User');
         $user->setPrenom('Denis');
         // password is moustache
         $user->setPassword('$2y$13$KospP1ZKp5NS8aIyftCu3.RhAfM7/hFv5jv4S85fTOVxgFuFm7qRq');
         $user->setRoles(['ROLE_USER']);
         $user->setActif('1');
         $manager->persist($user);

        $manager->flush();

        //commande pour lancer les fixtures
        //php bin/console doctrine:fixtures:load
    }
}
