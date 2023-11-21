<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116132257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table "token"';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TYPE token_type_enum AS ENUM (\'provider\',\'user\')');
        $this->addSql('CREATE TABLE token (id INT NOT NULL, provider_id INT NOT NULL, owner_id INT DEFAULT NULL, type token_type_enum NOT NULL, access_token VARCHAR(40) NOT NULL, refresh_token VARCHAR(40) NOT NULL, expired_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F37A13BA53A8AA ON token (provider_id)');
        $this->addSql('CREATE INDEX IDX_5F37A13B7E3C61F9 ON token (owner_id)');
        $this->addSql('CREATE INDEX token_access_token_idx ON token (access_token)');
        $this->addSql('COMMENT ON COLUMN token.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13BA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE token_id_seq CASCADE');
        $this->addSql('ALTER TABLE token DROP CONSTRAINT FK_5F37A13BA53A8AA');
        $this->addSql('ALTER TABLE token DROP CONSTRAINT FK_5F37A13B7E3C61F9');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP type token_type_enum');
    }
}
