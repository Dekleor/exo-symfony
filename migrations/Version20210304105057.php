<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304105057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE components ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE computers ADD updated_at DATETIME NOT NULL, ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE devices ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE components DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE computers DROP updated_at, DROP created_at');
        $this->addSql('ALTER TABLE devices DROP created_at, DROP updated_at');
    }
}
