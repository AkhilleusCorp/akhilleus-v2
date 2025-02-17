<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215161850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE
          EXERCISE
        ADD
          target_reps INT DEFAULT NULL,
        ADD
          target_weight INT DEFAULT NULL,
        ADD
          target_duration INT DEFAULT NULL,
        ADD
          target_distance INT DEFAULT NULL,
        ADD
          target_speed INT DEFAULT NULL,
        ADD
          reps INT DEFAULT NULL,
        ADD
          weight INT DEFAULT NULL,
        ADD
          duration INT DEFAULT NULL,
        ADD
          distance INT DEFAULT NULL,
        ADD
          speed INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE
          EXERCISE
        DROP
          target_reps,
        DROP
          target_weight,
        DROP
          target_duration,
        DROP
          target_distance,
        DROP
          target_speed,
        DROP
          reps,
        DROP
          weight,
        DROP
          duration,
        DROP
          distance,
        DROP
          speed');
    }
}
