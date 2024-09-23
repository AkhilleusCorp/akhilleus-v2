<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240923083948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE USER ADD COLUMN status VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__USER AS SELECT id, username, email, password, type FROM USER');
        $this->addSql('DROP TABLE USER');
        $this->addSql('CREATE TABLE USER (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL)');
        $this->addSql('INSERT INTO USER (id, username, email, password, type) SELECT id, username, email, password, type FROM __temp__USER');
        $this->addSql('DROP TABLE __temp__USER');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFDF85E0677 ON USER (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFDE7927C74 ON USER (email)');
    }
}
