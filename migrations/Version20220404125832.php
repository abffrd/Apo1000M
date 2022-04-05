<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404125832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoptant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adoption (id INT AUTO_INCREMENT NOT NULL, adoptant_id INT DEFAULT NULL, date_appel DATE DEFAULT NULL, compte_rendu LONGTEXT DEFAULT NULL, retour_animaux_proposes LONGTEXT DEFAULT NULL, date_rencontre DATE DEFAULT NULL, retour_rencontre_adoptant LONGTEXT DEFAULT NULL, retour_rencontre_fa LONGTEXT DEFAULT NULL, date_visite DATE DEFAULT NULL, retour_visite LONGTEXT DEFAULT NULL, date_adoption DATE DEFAULT NULL, date_depart DATE DEFAULT NULL, remarque LONGTEXT DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, animaux_proposes LONGTEXT DEFAULT NULL, INDEX IDX_EDDEB6A98D8B49F9 (adoptant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, famille_accueil_id INT DEFAULT NULL, espece_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, tests VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, vaccins VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, identification VARCHAR(255) DEFAULT NULL, sterilise TINYINT(1) DEFAULT NULL, INDEX IDX_6AAB231F886AA06B (famille_accueil_id), INDEX IDX_6AAB231F2D191E7A (espece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espece (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille_accueil (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille_accueil_espece (famille_accueil_id INT NOT NULL, espece_id INT NOT NULL, INDEX IDX_9B43F54C886AA06B (famille_accueil_id), INDEX IDX_9B43F54C2D191E7A (espece_id), PRIMARY KEY(famille_accueil_id, espece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, identifiant VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_role (membre_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_174B36556A99F74A (membre_id), INDEX IDX_174B3655D60322AC (role_id), PRIMARY KEY(membre_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_adoption (membre_id INT NOT NULL, adoption_id INT NOT NULL, INDEX IDX_58BC5E9A6A99F74A (membre_id), INDEX IDX_58BC5E9A631C55DF (adoption_id), PRIMARY KEY(membre_id, adoption_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adoption ADD CONSTRAINT FK_EDDEB6A98D8B49F9 FOREIGN KEY (adoptant_id) REFERENCES adoptant (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F886AA06B FOREIGN KEY (famille_accueil_id) REFERENCES famille_accueil (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F2D191E7A FOREIGN KEY (espece_id) REFERENCES espece (id)');
        $this->addSql('ALTER TABLE famille_accueil_espece ADD CONSTRAINT FK_9B43F54C886AA06B FOREIGN KEY (famille_accueil_id) REFERENCES famille_accueil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE famille_accueil_espece ADD CONSTRAINT FK_9B43F54C2D191E7A FOREIGN KEY (espece_id) REFERENCES espece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_role ADD CONSTRAINT FK_174B36556A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_role ADD CONSTRAINT FK_174B3655D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_adoption ADD CONSTRAINT FK_58BC5E9A6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_adoption ADD CONSTRAINT FK_58BC5E9A631C55DF FOREIGN KEY (adoption_id) REFERENCES adoption (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoption DROP FOREIGN KEY FK_EDDEB6A98D8B49F9');
        $this->addSql('ALTER TABLE membre_adoption DROP FOREIGN KEY FK_58BC5E9A631C55DF');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F2D191E7A');
        $this->addSql('ALTER TABLE famille_accueil_espece DROP FOREIGN KEY FK_9B43F54C2D191E7A');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F886AA06B');
        $this->addSql('ALTER TABLE famille_accueil_espece DROP FOREIGN KEY FK_9B43F54C886AA06B');
        $this->addSql('ALTER TABLE membre_role DROP FOREIGN KEY FK_174B36556A99F74A');
        $this->addSql('ALTER TABLE membre_adoption DROP FOREIGN KEY FK_58BC5E9A6A99F74A');
        $this->addSql('ALTER TABLE membre_role DROP FOREIGN KEY FK_174B3655D60322AC');
        $this->addSql('DROP TABLE adoptant');
        $this->addSql('DROP TABLE adoption');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE espece');
        $this->addSql('DROP TABLE famille_accueil');
        $this->addSql('DROP TABLE famille_accueil_espece');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE membre_role');
        $this->addSql('DROP TABLE membre_adoption');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
