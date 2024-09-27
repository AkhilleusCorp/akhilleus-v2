<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240927115511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE EQUIPMENT (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_97FACB6C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER (id INT AUTO_INCREMENT NOT NULL, lifecycle_id INT DEFAULT NULL, configuration_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, status VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_BB063BFDF85E0677 (username), UNIQUE INDEX UNIQ_BB063BFDE7927C74 (email), UNIQUE INDEX UNIQ_BB063BFDD7D7318C (lifecycle_id), UNIQUE INDEX UNIQ_BB063BFD73F32DD8 (configuration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER_CONFIGURATION (id INT AUTO_INCREMENT NOT NULL, date_format VARCHAR(20) NOT NULL, weight_unit VARCHAR(20) NOT NULL, distance_unit VARCHAR(20) NOT NULL, measurement_unit VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER_LIFECYCLE (id INT AUTO_INCREMENT NOT NULL, registration_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_modification_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_login_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_completed_workout_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE WORKOUT (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, status VARCHAR(15) NOT NULL, visibility VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_5BDA05685E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE USER ADD CONSTRAINT FK_BB063BFDD7D7318C FOREIGN KEY (lifecycle_id) REFERENCES USER_LIFECYCLE (id)');
        $this->addSql('ALTER TABLE USER ADD CONSTRAINT FK_BB063BFD73F32DD8 FOREIGN KEY (configuration_id) REFERENCES USER_CONFIGURATION (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE USER DROP FOREIGN KEY FK_BB063BFDD7D7318C');
        $this->addSql('ALTER TABLE USER DROP FOREIGN KEY FK_BB063BFD73F32DD8');
        $this->addSql('DROP TABLE EQUIPMENT');
        $this->addSql('DROP TABLE USER');
        $this->addSql('DROP TABLE USER_CONFIGURATION');
        $this->addSql('DROP TABLE USER_LIFECYCLE');
        $this->addSql('DROP TABLE WORKOUT');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
