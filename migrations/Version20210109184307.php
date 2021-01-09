<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109184307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD position_id INT DEFAULT NULL, DROP latitude, DROP longitude');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B0234DD842E46 ON city (position_id)');
        $this->addSql('ALTER TABLE station ADD position_id INT DEFAULT NULL, DROP latitude, DROP longitude');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B1DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F39F8B1DD842E46 ON station (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234DD842E46');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B1DD842E46');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP INDEX UNIQ_2D5B0234DD842E46 ON city');
        $this->addSql('ALTER TABLE city ADD latitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD longitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP position_id');
        $this->addSql('DROP INDEX UNIQ_9F39F8B1DD842E46 ON station');
        $this->addSql('ALTER TABLE station ADD latitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD longitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP position_id');
    }
}
