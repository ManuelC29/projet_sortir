<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121130901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trips ADD organizer_id INT NOT NULL, DROP organizer');
        $this->addSql('ALTER TABLE trips ADD CONSTRAINT FK_AA7370DA876C4DDA FOREIGN KEY (organizer_id) REFERENCES participants (id)');
        $this->addSql('CREATE INDEX IDX_AA7370DA876C4DDA ON trips (organizer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trips DROP FOREIGN KEY FK_AA7370DA876C4DDA');
        $this->addSql('DROP INDEX IDX_AA7370DA876C4DDA ON trips');
        $this->addSql('ALTER TABLE trips ADD organizer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP organizer_id');
    }
}
