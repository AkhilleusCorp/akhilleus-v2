<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208095643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE
          MOVEMENT
        ADD
          has_reps TINYINT(1) NOT NULL,
        ADD
          has_weight TINYINT(1) NOT NULL,
        ADD
          has_duration TINYINT(1) NOT NULL,
        ADD
          has_distance TINYINT(1) NOT NULL,
        ADD
          has_speed TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE
          MOVEMENT
        DROP
          has_reps,
        DROP
          has_weight,
        DROP
          has_duration,
        DROP
          has_distance,
        DROP
          has_speed');
    }
}
