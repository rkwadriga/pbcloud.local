<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116131448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table "user"';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, provider_id INT NOT NULL, shop_id INT DEFAULT NULL, provider_user_id VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, roles TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649A53A8AA ON "user" (provider_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494D16C4DD ON "user" (shop_id)');
        $this->addSql('CREATE INDEX user_provider_email_idx ON "user" (provider_id, email)');
        $this->addSql('CREATE INDEX user_provider_id_shop_idx ON "user" (provider_id, provider_user_id, shop_id)');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6494D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649A53A8AA');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6494D16C4DD');
        $this->addSql('DROP TABLE "user"');
    }
}
