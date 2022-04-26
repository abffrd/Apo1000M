<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426185854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, adoptant_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start DATETIME DEFAULT NULL, end DATETIME DEFAULT NULL, background_color VARCHAR(255) DEFAULT NULL, text_color VARCHAR(255) DEFAULT NULL, all_day TINYINT(1) DEFAULT NULL, INDEX IDX_6EA9A1468D8B49F9 (adoptant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1468D8B49F9 FOREIGN KEY (adoptant_id) REFERENCES adoptant (id)');
        $this->addSql('ALTER TABLE user_adoption DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_adoption ADD PRIMARY KEY (adoption_id, user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE calendar');
        $this->addSql('ALTER TABLE user_adoption DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_adoption ADD PRIMARY KEY (user_id, adoption_id)');
    }
}
