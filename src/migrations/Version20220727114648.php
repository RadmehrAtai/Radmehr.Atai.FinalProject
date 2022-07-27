<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727114648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE glasses (id INT AUTO_INCREMENT NOT NULL, glasses_store_id INT NOT NULL, frame_material VARCHAR(255) NOT NULL, frame_form VARCHAR(255) NOT NULL, frame_color VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, lenz_material VARCHAR(255) NOT NULL, face_form VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_F6A25AD62E56028F (glasses_store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glasses_store (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, INDEX IDX_9580425F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE glasses ADD CONSTRAINT FK_F6A25AD62E56028F FOREIGN KEY (glasses_store_id) REFERENCES glasses_store (id)');
        $this->addSql('ALTER TABLE glasses_store ADD CONSTRAINT FK_9580425F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE glasses DROP FOREIGN KEY FK_F6A25AD62E56028F');
        $this->addSql('ALTER TABLE glasses_store DROP FOREIGN KEY FK_9580425F7E3C61F9');
        $this->addSql('DROP TABLE glasses');
        $this->addSql('DROP TABLE glasses_store');
        $this->addSql('DROP TABLE user');
    }
}
