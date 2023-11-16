<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116083230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE provider_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TYPE provider_type_enum AS ENUM (\'partner\',\'local\')');
        $this->addSql('CREATE TABLE provider (id INT NOT NULL, name VARCHAR(64) NOT NULL, alias VARCHAR(16) NOT NULL, api_key VARCHAR(16) NOT NULL, api_secret VARCHAR(64) NOT NULL, type provider_type_enum, status is_active_status_enum, extra JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX provider_alias_idx ON provider (alias)');
        $this->addSql('COMMENT ON COLUMN provider.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE provider_id_seq CASCADE');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP type provider_type_enum');
    }
}
