<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116130228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table "shop"';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE shop_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE shop (id INT NOT NULL, provider_id INT NOT NULL, name VARCHAR(255) NOT NULL, extra JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AC6A4CA2A53A8AA ON shop (provider_id)');
        $this->addSql('COMMENT ON COLUMN shop.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA2A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE shop_id_seq CASCADE');
        $this->addSql('ALTER TABLE shop DROP CONSTRAINT FK_AC6A4CA2A53A8AA');
        $this->addSql('DROP TABLE shop');
    }
}
