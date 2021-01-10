<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110202520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B18BAC62AF');
        $this->addSql('DROP INDEX IDX_9F39F8B18BAC62AF ON station');
        $this->addSql('ALTER TABLE station DROP city_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE station ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B18BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_9F39F8B18BAC62AF ON station (city_id)');
    }
}
