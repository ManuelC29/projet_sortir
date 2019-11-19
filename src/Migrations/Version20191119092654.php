<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191119092654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092F6BD1646 FOREIGN KEY (site_id) REFERENCES sites (id)');
        $this->addSql('CREATE INDEX IDX_71697092F6BD1646 ON participants (site_id)');
        $this->addSql('ALTER TABLE places ADD city_id INT NOT NULL, CHANGE street street VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C558BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('CREATE INDEX IDX_FEAF6C558BAC62AF ON places (city_id)');
        $this->addSql('ALTER TABLE registrations ADD participants_id INT NOT NULL, ADD registration_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7838709D5 FOREIGN KEY (participants_id) REFERENCES trips (id)');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7833D8F43 FOREIGN KEY (registration_id) REFERENCES participants (id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7838709D5 ON registrations (participants_id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7833D8F43 ON registrations (registration_id)');
        $this->addSql('ALTER TABLE trips ADD status_id INT NOT NULL, ADD place_id INT NOT NULL, ADD participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DA6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DADA6A219 FOREIGN KEY (place_id) REFERENCES places (id)');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DA9D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('CREATE INDEX IDX_AA7370DA6BF700BD ON trips (status_id)');
        $this->addSql('CREATE INDEX IDX_AA7370DADA6A219 ON trips (place_id)');
        $this->addSql('CREATE INDEX IDX_AA7370DA9D1C3019 ON trips (participant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092F6BD1646');
        $this->addSql('DROP INDEX IDX_71697092F6BD1646 ON participants');
        $this->addSql('ALTER TABLE participants DROP site_id');
        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C558BAC62AF');
        $this->addSql('DROP INDEX IDX_FEAF6C558BAC62AF ON places');
        $this->addSql('ALTER TABLE places DROP city_id, CHANGE street street VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7838709D5');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7833D8F43');
        $this->addSql('DROP INDEX IDX_53DE51E7838709D5 ON registrations');
        $this->addSql('DROP INDEX IDX_53DE51E7833D8F43 ON registrations');
        $this->addSql('ALTER TABLE registrations DROP participants_id, DROP registration_id');
        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DA6BF700BD');
        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DADA6A219');
        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DA9D1C3019');
        $this->addSql('DROP INDEX IDX_AA7370DA6BF700BD ON trips');
        $this->addSql('DROP INDEX IDX_AA7370DADA6A219 ON trips');
        $this->addSql('DROP INDEX IDX_AA7370DA9D1C3019 ON trips');
        $this->addSql('ALTER TABLE trips DROP status_id, DROP place_id, DROP participant_id');
    }
}
