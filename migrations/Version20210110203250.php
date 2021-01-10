<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110203250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B1BD6D436E FOREIGN KEY (city_name) REFERENCES city (name)');
        $this->addSql('CREATE INDEX IDX_9F39F8B1BD6D436E ON station (city_name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B1BD6D436E');
        $this->addSql('DROP INDEX IDX_9F39F8B1BD6D436E ON station');
    }
}
