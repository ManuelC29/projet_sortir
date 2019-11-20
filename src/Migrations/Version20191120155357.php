<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120155357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DA9D1C3019');
        $this->addSql('DROP INDEX IDX_AA7370DA9D1C3019 ON trips');
        $this->addSql('ALTER TABLE trips ADD participant JSON DEFAULT NULL, DROP participant_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trips ADD participant_id INT DEFAULT NULL, DROP participant');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DA9D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('CREATE INDEX IDX_AA7370DA9D1C3019 ON trips (participant_id)');
    }
}
