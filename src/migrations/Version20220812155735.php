<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812155735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE glasses DROP FOREIGN KEY FK_F6A25AD6462F07AF');
        $this->addSql('DROP INDEX FK_F6A25AD6462F07AF ON glasses');
        $this->addSql('ALTER TABLE glasses ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, DROP product_order_id, DROP created_user, DROP updated_user');
        $this->addSql('ALTER TABLE glasses_store ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, DROP created_user, DROP updated_user');
        $this->addSql('ALTER TABLE `order` CHANGE product_id product_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE glasses ADD product_order_id INT DEFAULT NULL, ADD created_user VARCHAR(255) DEFAULT NULL, ADD updated_user VARCHAR(255) DEFAULT NULL, DROP created_by, DROP updated_by');
        $this->addSql('ALTER TABLE glasses ADD CONSTRAINT FK_F6A25AD6462F07AF FOREIGN KEY (product_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX FK_F6A25AD6462F07AF ON glasses (product_order_id)');
        $this->addSql('ALTER TABLE glasses_store ADD created_user VARCHAR(255) DEFAULT NULL, ADD updated_user VARCHAR(255) DEFAULT NULL, DROP created_by, DROP updated_by');
        $this->addSql('ALTER TABLE `order` CHANGE product_id product_id INT DEFAULT NULL');
    }
}
