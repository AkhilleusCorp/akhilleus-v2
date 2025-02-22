<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250222202002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE EXERCISE_GROUP ADD rest_duration INT DEFAULT NULL');
        $this->addSql('ALTER TABLE
          EXERCISE
        CHANGE
          target_weight target_weight DOUBLE PRECISION DEFAULT NULL,
        CHANGE
          target_distance target_distance DOUBLE PRECISION DEFAULT NULL,
        CHANGE
          target_speed target_speed DOUBLE PRECISION DEFAULT NULL,
        CHANGE
          weight weight DOUBLE PRECISION DEFAULT NULL,
        CHANGE
          distance distance DOUBLE PRECISION DEFAULT NULL,
        CHANGE
          speed speed DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE EXERCISE_GROUP DROP rest_duration');
        $this->addSql('ALTER TABLE
          EXERCISE
        CHANGE
          target_weight target_weight INT DEFAULT NULL,
        CHANGE
          target_distance target_distance INT DEFAULT NULL,
        CHANGE
          target_speed target_speed INT DEFAULT NULL,
        CHANGE
          weight weight INT DEFAULT NULL,
        CHANGE
          distance distance INT DEFAULT NULL,
        CHANGE
          speed speed INT NULL');
    }
}
