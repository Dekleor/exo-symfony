<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304090741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE components (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, type VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE computers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE computers_components (computers_id INT NOT NULL, components_id INT NOT NULL, INDEX IDX_9926FD46F4B903A6 (computers_id), INDEX IDX_9926FD46CA91F907 (components_id), PRIMARY KEY(computers_id, components_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE computers_devices (computers_id INT NOT NULL, devices_id INT NOT NULL, INDEX IDX_908F067DF4B903A6 (computers_id), INDEX IDX_908F067D665B0F2F (devices_id), PRIMARY KEY(computers_id, devices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devices (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, brand VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE computers_components ADD CONSTRAINT FK_9926FD46F4B903A6 FOREIGN KEY (computers_id) REFERENCES computers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE computers_components ADD CONSTRAINT FK_9926FD46CA91F907 FOREIGN KEY (components_id) REFERENCES components (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE computers_devices ADD CONSTRAINT FK_908F067DF4B903A6 FOREIGN KEY (computers_id) REFERENCES computers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE computers_devices ADD CONSTRAINT FK_908F067D665B0F2F FOREIGN KEY (devices_id) REFERENCES devices (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE computers_components DROP FOREIGN KEY FK_9926FD46CA91F907');
        $this->addSql('ALTER TABLE computers_components DROP FOREIGN KEY FK_9926FD46F4B903A6');
        $this->addSql('ALTER TABLE computers_devices DROP FOREIGN KEY FK_908F067DF4B903A6');
        $this->addSql('ALTER TABLE computers_devices DROP FOREIGN KEY FK_908F067D665B0F2F');
        $this->addSql('DROP TABLE components');
        $this->addSql('DROP TABLE computers');
        $this->addSql('DROP TABLE computers_components');
        $this->addSql('DROP TABLE computers_devices');
        $this->addSql('DROP TABLE devices');
    }
}
