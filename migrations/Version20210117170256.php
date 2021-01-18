<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117170256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE record (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, artist_name VARCHAR(255) DEFAULT NULL, type VARCHAR(50) NOT NULL, year INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE track (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, record_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, artist_name VARCHAR(255) DEFAULT NULL, year INTEGER NOT NULL, duration INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A64DFD750C ON track (record_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE track');
    }
}
