<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200823204644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'create the joke table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joke (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, joke CLOB NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE joke');
    }
}
