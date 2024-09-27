<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240927093342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE EQUIPMENT (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(150) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97FACB6C5E237E06 ON EQUIPMENT (name)');
        $this->addSql('CREATE TABLE USER (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lifecycle_id INTEGER DEFAULT NULL, configuration_id INTEGER DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, status VARCHAR(15) NOT NULL, CONSTRAINT FK_BB063BFDD7D7318C FOREIGN KEY (lifecycle_id) REFERENCES USER_LIFECYCLE (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BB063BFD73F32DD8 FOREIGN KEY (configuration_id) REFERENCES USER_CONFIGURATION (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFDF85E0677 ON USER (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFDE7927C74 ON USER (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFDD7D7318C ON USER (lifecycle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFD73F32DD8 ON USER (configuration_id)');
        $this->addSql('CREATE TABLE USER_CONFIGURATION (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_format VARCHAR(20) NOT NULL, weight_unit VARCHAR(20) NOT NULL, distance_unit VARCHAR(20) NOT NULL, measurement_unit VARCHAR(20) NOT NULL)');
        $this->addSql('CREATE TABLE USER_LIFECYCLE (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, registration_date DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , last_modification_date DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , last_login_date DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , last_completed_workout_date DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE TABLE WORKOUT (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(150) NOT NULL, status VARCHAR(15) NOT NULL, visibility VARCHAR(20) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5BDA05685E237E06 ON WORKOUT (name)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE EQUIPMENT');
        $this->addSql('DROP TABLE USER');
        $this->addSql('DROP TABLE USER_CONFIGURATION');
        $this->addSql('DROP TABLE USER_LIFECYCLE');
        $this->addSql('DROP TABLE WORKOUT');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
