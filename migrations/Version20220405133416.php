<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405133416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE membre_adoption');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE membre_adoption (membre_id INT NOT NULL, adoption_id INT NOT NULL, INDEX IDX_58BC5E9A6A99F74A (membre_id), INDEX IDX_58BC5E9A631C55DF (adoption_id), PRIMARY KEY(membre_id, adoption_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE membre_adoption ADD CONSTRAINT FK_58BC5E9A631C55DF FOREIGN KEY (adoption_id) REFERENCES adoption (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_adoption ADD CONSTRAINT FK_58BC5E9A6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
    }
}
