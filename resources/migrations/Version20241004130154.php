<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004130154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE EQUIPMENT (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_97FACB6C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE EXERCISE (id INT AUTO_INCREMENT NOT NULL, movement_id INT DEFAULT NULL, group_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, is_completed TINYINT(1) NOT NULL, INDEX IDX_68E94950229E70A7 (movement_id), INDEX IDX_68E94950FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE EXERCISE_GROUP (id INT AUTO_INCREMENT NOT NULL, workout_id INT DEFAULT NULL, movement_ids LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_A472CC0CA6CCCFC9 (workout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MOVEMENT (id INT AUTO_INCREMENT NOT NULL, primary_muscle_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_32EE09BB5E237E06 (name), INDEX IDX_32EE09BBFFD46653 (primary_muscle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MOVEMENTS_MUSCLES (movement_id INT NOT NULL, muscle_id INT NOT NULL, INDEX IDX_67E2B66F229E70A7 (movement_id), INDEX IDX_67E2B66F354FDBB4 (muscle_id), PRIMARY KEY(movement_id, muscle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MOVEMENTS_EQUIPMENTS (movement_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_BD22185229E70A7 (movement_id), INDEX IDX_BD22185517FE9FE (equipment_id), PRIMARY KEY(movement_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MUSCLE (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_3E9DE695E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER (id INT AUTO_INCREMENT NOT NULL, lifecycle_id INT DEFAULT NULL, configuration_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, status VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_BB063BFDF85E0677 (username), UNIQUE INDEX UNIQ_BB063BFDE7927C74 (email), UNIQUE INDEX UNIQ_BB063BFDD7D7318C (lifecycle_id), UNIQUE INDEX UNIQ_BB063BFD73F32DD8 (configuration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER_CONFIGURATION (id INT AUTO_INCREMENT NOT NULL, date_format VARCHAR(20) NOT NULL, weight_unit VARCHAR(20) NOT NULL, distance_unit VARCHAR(20) NOT NULL, measurement_unit VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER_LIFECYCLE (id INT AUTO_INCREMENT NOT NULL, registration_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_modification_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_login_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_completed_workout_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE WORKOUT (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, status VARCHAR(15) NOT NULL, visibility VARCHAR(20) NOT NULL, start_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', planned_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', duration INT DEFAULT NULL, UNIQUE INDEX UNIQ_5BDA05685E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE EXERCISE ADD CONSTRAINT FK_68E94950229E70A7 FOREIGN KEY (movement_id) REFERENCES MOVEMENT (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE EXERCISE ADD CONSTRAINT FK_68E94950FE54D947 FOREIGN KEY (group_id) REFERENCES EXERCISE_GROUP (id)');
        $this->addSql('ALTER TABLE EXERCISE_GROUP ADD CONSTRAINT FK_A472CC0CA6CCCFC9 FOREIGN KEY (workout_id) REFERENCES WORKOUT (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE MOVEMENT ADD CONSTRAINT FK_32EE09BBFFD46653 FOREIGN KEY (primary_muscle_id) REFERENCES MUSCLE (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE MOVEMENTS_MUSCLES ADD CONSTRAINT FK_67E2B66F229E70A7 FOREIGN KEY (movement_id) REFERENCES MOVEMENT (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE MOVEMENTS_MUSCLES ADD CONSTRAINT FK_67E2B66F354FDBB4 FOREIGN KEY (muscle_id) REFERENCES MUSCLE (id)');
        $this->addSql('ALTER TABLE MOVEMENTS_EQUIPMENTS ADD CONSTRAINT FK_BD22185229E70A7 FOREIGN KEY (movement_id) REFERENCES MOVEMENT (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE MOVEMENTS_EQUIPMENTS ADD CONSTRAINT FK_BD22185517FE9FE FOREIGN KEY (equipment_id) REFERENCES EQUIPMENT (id)');
        $this->addSql('ALTER TABLE USER ADD CONSTRAINT FK_BB063BFDD7D7318C FOREIGN KEY (lifecycle_id) REFERENCES USER_LIFECYCLE (id)');
        $this->addSql('ALTER TABLE USER ADD CONSTRAINT FK_BB063BFD73F32DD8 FOREIGN KEY (configuration_id) REFERENCES USER_CONFIGURATION (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE EXERCISE DROP FOREIGN KEY FK_68E94950229E70A7');
        $this->addSql('ALTER TABLE EXERCISE DROP FOREIGN KEY FK_68E94950FE54D947');
        $this->addSql('ALTER TABLE EXERCISE_GROUP DROP FOREIGN KEY FK_A472CC0CA6CCCFC9');
        $this->addSql('ALTER TABLE MOVEMENT DROP FOREIGN KEY FK_32EE09BBFFD46653');
        $this->addSql('ALTER TABLE MOVEMENTS_MUSCLES DROP FOREIGN KEY FK_67E2B66F229E70A7');
        $this->addSql('ALTER TABLE MOVEMENTS_MUSCLES DROP FOREIGN KEY FK_67E2B66F354FDBB4');
        $this->addSql('ALTER TABLE MOVEMENTS_EQUIPMENTS DROP FOREIGN KEY FK_BD22185229E70A7');
        $this->addSql('ALTER TABLE MOVEMENTS_EQUIPMENTS DROP FOREIGN KEY FK_BD22185517FE9FE');
        $this->addSql('ALTER TABLE USER DROP FOREIGN KEY FK_BB063BFDD7D7318C');
        $this->addSql('ALTER TABLE USER DROP FOREIGN KEY FK_BB063BFD73F32DD8');
        $this->addSql('DROP TABLE EQUIPMENT');
        $this->addSql('DROP TABLE EXERCISE');
        $this->addSql('DROP TABLE EXERCISE_GROUP');
        $this->addSql('DROP TABLE MOVEMENT');
        $this->addSql('DROP TABLE MOVEMENTS_MUSCLES');
        $this->addSql('DROP TABLE MOVEMENTS_EQUIPMENTS');
        $this->addSql('DROP TABLE MUSCLE');
        $this->addSql('DROP TABLE USER');
        $this->addSql('DROP TABLE USER_CONFIGURATION');
        $this->addSql('DROP TABLE USER_LIFECYCLE');
        $this->addSql('DROP TABLE WORKOUT');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
