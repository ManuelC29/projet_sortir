<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120090408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants CHANGE url_photo url_photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7A5BC2E0E');
        $this->addSql('DROP INDEX IDX_53DE51E7A5BC2E0E ON registrations');
        $this->addSql('ALTER TABLE registrations DROP trip_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants CHANGE url_photo url_photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE registrations ADD trip_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trips (id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7A5BC2E0E ON registrations (trip_id)');
    }
}
