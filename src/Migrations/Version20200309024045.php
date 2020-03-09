<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309024045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FAF675F31B');
        $this->addSql('DROP INDEX IDX_631EF2FAF675F31B ON mods');
        $this->addSql('ALTER TABLE mods DROP author_id');
        $this->addSql('ALTER TABLE user ADD bio LONGTEXT DEFAULT NULL, ADD instagram VARCHAR(255) DEFAULT NULL, ADD snapshat VARCHAR(255) DEFAULT NULL, ADD real_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mods ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FAF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_631EF2FAF675F31B ON mods (author_id)');
        $this->addSql('ALTER TABLE user DROP bio, DROP instagram, DROP snapshat, DROP real_name');
    }
}