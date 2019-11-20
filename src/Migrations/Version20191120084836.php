<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120084836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants CHANGE site_id site_id INT NOT NULL, CHANGE phone phone VARCHAR(15) NOT NULL, CHANGE password password VARCHAR(30) NOT NULL, CHANGE administrator administrator TINYINT(1) NOT NULL, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE registrations ADD trips_id INT NOT NULL');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E76C2C0C FOREIGN KEY (trips_id) REFERENCES trips (id)');
        $this->addSql('CREATE INDEX IDX_53DE51E76C2C0C ON registrations (trips_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants CHANGE site_id site_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE administrator administrator TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE active active TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E76C2C0C');
        $this->addSql('DROP INDEX IDX_53DE51E76C2C0C ON registrations');
        $this->addSql('ALTER TABLE registrations DROP trips_id');
    }
}
