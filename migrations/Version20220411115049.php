<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411115049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre_role DROP FOREIGN KEY FK_174B36556A99F74A');
        $this->addSql('DROP TABLE animal_adoption');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE membre_role');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B42F2A450FF010 ON adoptant (telephone)');
        $this->addSql('ALTER TABLE animal ADD adoption_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F631C55DF FOREIGN KEY (adoption_id) REFERENCES adoption (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F631C55DF ON animal (adoption_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal_adoption (animal_id INT NOT NULL, adoption_id INT NOT NULL, INDEX IDX_2B5DB0748E962C16 (animal_id), INDEX IDX_2B5DB074631C55DF (adoption_id), PRIMARY KEY(animal_id, adoption_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, identifiant VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE membre_role (membre_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_174B36556A99F74A (membre_id), INDEX IDX_174B3655D60322AC (role_id), PRIMARY KEY(membre_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE animal_adoption ADD CONSTRAINT FK_2B5DB0748E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_adoption ADD CONSTRAINT FK_2B5DB074631C55DF FOREIGN KEY (adoption_id) REFERENCES adoption (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_role ADD CONSTRAINT FK_174B3655D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_role ADD CONSTRAINT FK_174B36556A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_7B42F2A450FF010 ON adoptant');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F631C55DF');
        $this->addSql('DROP INDEX IDX_6AAB231F631C55DF ON animal');
        $this->addSql('ALTER TABLE animal DROP adoption_id');
    }
}