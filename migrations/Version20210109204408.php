<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109204408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02346BF700BD');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B16BF700BD');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP INDEX IDX_2D5B02346BF700BD ON city');
        $this->addSql('ALTER TABLE city ADD status VARCHAR(255) NOT NULL, DROP status_id');
        $this->addSql('DROP INDEX IDX_9F39F8B16BF700BD ON station');
        $this->addSql('ALTER TABLE station ADD status VARCHAR(255) NOT NULL, DROP status_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE city ADD status_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02346BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_2D5B02346BF700BD ON city (status_id)');
        $this->addSql('ALTER TABLE station ADD status_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B16BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_9F39F8B16BF700BD ON station (status_id)');
    }
}
