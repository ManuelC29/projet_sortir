<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120090048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /*$this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, name_city VARCHAR(50) NOT NULL, zip VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, nickname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, phone VARCHAR(15) NOT NULL, mail VARCHAR(50) NOT NULL, password VARCHAR(30) NOT NULL, url_photo VARCHAR(255) DEFAULT NULL, administrator TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_71697092F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, name_place VARCHAR(50) NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, INDEX IDX_FEAF6C558BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registrations (id INT AUTO_INCREMENT NOT NULL, participant_id INT DEFAULT NULL, trip_id INT DEFAULT NULL, trips_id INT NOT NULL, date_registration DATETIME NOT NULL, INDEX IDX_53DE51E79D1C3019 (participant_id), INDEX IDX_53DE51E7A5BC2E0E (trip_id), INDEX IDX_53DE51E76C2C0C (trips_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sites (id INT AUTO_INCREMENT NOT NULL, name_site VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trips (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, place_id INT NOT NULL, participant_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, date_start DATETIME NOT NULL, duration DATETIME NOT NULL, date_closing DATETIME NOT NULL, max_registration INT NOT NULL, description_infos VARCHAR(255) NOT NULL, organizer VARCHAR(255) NOT NULL, INDEX IDX_AA7370DA6BF700BD (status_id), INDEX IDX_AA7370DADA6A219 (place_id), INDEX IDX_AA7370DA9D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092F6BD1646 FOREIGN KEY (site_id) REFERENCES sites (id)');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C558BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E79D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trips (id)');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E76C2C0C FOREIGN KEY (trips_id) REFERENCES trips (id)');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DA6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DADA6A219 FOREIGN KEY (place_id) REFERENCES places (id)');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DA9D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');*/
    }

    public function down(Schema $schema) : void
    {
      /*  // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C558BAC62AF');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E79D1C3019');
        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DA9D1C3019');
        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DADA6A219');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092F6BD1646');
        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DA6BF700BD');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7A5BC2E0E');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E76C2C0C');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE participants');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP TABLE registrations');
        $this->addSql('DROP TABLE sites');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE trips');*/
    }
}
