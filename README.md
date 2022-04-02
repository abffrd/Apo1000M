# projet-02-1000-moustaches

## Présentation du projet

Créer un back office pour le site d’une association de protection animale afin de gérer les adoptions, les bénévoles, les familles d’accueil.

## Présentation de l'association

L’association 1000 Moustaches a vu le jour en mars 2020. Elle soutient le travail des associations existantes en Loire-Atlantique (Nantes – 44).
Face à l’ampleur des abandons, des négligences, du manque d’estime dont sont victimes les animaux, nous souhaitons apporter notre contribution. Celle-ci passe par la sensibilisation des humains.
En effet, les animaux sont des individus sensibles, qui méritent amour, respect et bienveillance.
https://www.1000moustaches.fr/

## Commande pour installer le projet

Avant de cloner le projet sur sa machine, il est nécessaire de mettre à jour node pour le bon fonctionnement du framework front TailwindCSS

Mise à jour de node sur la VM

1. Installation d'un outil de gestion de versions de node

-  sudo npm install -g n

2. Installation de la version stable de node

- sudo n lts

3. Vérifier que la version installée est bien la 16.14.2 via la commande

- node --version

Après avoir cloné le projet depuis le repository github, on réinstalle les composants

 - composer install

Installation du framework TailwindCSS 3

 - npm install -D tailwindcss postcss autoprefixer
  
Finalisation de l'installation 

 - npm i

Vérifier que le pack encore de Symfony est bien installé en tapant la commande suivante

 - composer require symfony/webpack-encore-bundle

compilation automatique des fichiers CSS à chaque enregistrement

 - npm run dev --watch

Créer un fichier .env.local avec la ligne suivante

 - DATABASE_URL="mysql://utilisateur:utilisateur_password@127.0.0.1:3306/nom_de_la_base?serverVersion=mariadb-10.3.32&charset=utf8mb4"

Penser à vérifier la version de mariadb :

- mysql --version

Créer la base de données avec Symfony

 - php bin/console doctrine:database:create

nom de la base de données : 1000_moustaches

Créer un utilisateur et lui donner les droits d'accès à la base de données,
Modifier le fichier .env.local en conséquence

Effectuer les migrations dans la base de données

 - bin/console doctrine:migrations:migrate

Charger les fixtures si besoin

 - bin/console doctrine:fixtures:load

