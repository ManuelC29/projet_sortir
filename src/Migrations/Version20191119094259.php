<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191119094259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7833D8F43');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7838709D5');
        $this->addSql('DROP INDEX IDX_53DE51E7833D8F43 ON registrations');
        $this->addSql('DROP INDEX IDX_53DE51E7838709D5 ON registrations');
        $this->addSql('ALTER TABLE registrations ADD trip_id INT DEFAULT NULL, DROP participants_id, CHANGE registration_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E79D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trips (id)');
        $this->addSql('CREATE INDEX IDX_53DE51E79D1C3019 ON registrations (participant_id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7A5BC2E0E ON registrations (trip_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E79D1C3019');
        $this->addSql('ALTER TABLE registrations DROP FOREIGN KEY FK_53DE51E7A5BC2E0E');
        $this->addSql('DROP INDEX IDX_53DE51E79D1C3019 ON registrations');
        $this->addSql('DROP INDEX IDX_53DE51E7A5BC2E0E ON registrations');
        $this->addSql('ALTER TABLE registrations ADD participants_id INT NOT NULL, ADD registration_id INT DEFAULT NULL, DROP participant_id, DROP trip_id');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7833D8F43 FOREIGN KEY (registration_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7838709D5 FOREIGN KEY (participants_id) REFERENCES trips (id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7833D8F43 ON registrations (registration_id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7838709D5 ON registrations (participants_id)');
    }
}
