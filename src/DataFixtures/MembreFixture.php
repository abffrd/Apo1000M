<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MembreFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        /* $nbRoles = 5;
        $roleObjects = [];
        for ($i = 0; $i < $nbRoles; $i++) {
            $role = new Role();
            $role->setRole($faker->name());

            $roleObjects[] = $role;
            $manager->persist($role);
        } */

        //liste des roles dans un tableau
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



        $nbMembres = 20;
        $membresObjects = [];
        for ($i = 0; $i < $nbMembres; $i++){
            $membre = new Membre();
            $membre->setNom($faker->lastName());
            $membre->setPrenom($faker->firstNAme());
            $membre->setMotDePasse($faker->password());
            $membre->setIdentifiant($faker->word());
            $membre->setActif($faker->numberBetween(0, 5));


            $randomIndex = array_rand($roleObjects);
            $membre->addRole($roleObjects[$randomIndex]);

            $membresObjects[] = $membre;
            $manager->persist($membre);


        }

        


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
