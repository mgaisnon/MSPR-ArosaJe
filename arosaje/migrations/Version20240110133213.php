<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110133213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE plante_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_plant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plante (id INT NOT NULL, name VARCHAR(255) NOT NULL, weight VARCHAR(255) NOT NULL, species VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE user_plant (id INT NOT NULL, id_user_id INT NOT NULL, id_botaniste_id INT DEFAULT NULL, id_plant_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_49C1F62A79F37AE5 ON user_plant (id_user_id)');
        $this->addSql('CREATE INDEX IDX_49C1F62A24B80ABD ON user_plant (id_botaniste_id)');
        $this->addSql('CREATE INDEX IDX_49C1F62A4D48BAC7 ON user_plant (id_plant_id)');
        $this->addSql('ALTER TABLE user_plant ADD CONSTRAINT FK_49C1F62A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_plant ADD CONSTRAINT FK_49C1F62A24B80ABD FOREIGN KEY (id_botaniste_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_plant ADD CONSTRAINT FK_49C1F62A4D48BAC7 FOREIGN KEY (id_plant_id) REFERENCES plante (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE plante_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_plant_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_plant DROP CONSTRAINT FK_49C1F62A79F37AE5');
        $this->addSql('ALTER TABLE user_plant DROP CONSTRAINT FK_49C1F62A24B80ABD');
        $this->addSql('ALTER TABLE user_plant DROP CONSTRAINT FK_49C1F62A4D48BAC7');
        $this->addSql('DROP TABLE plante');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_plant');
    }
}
