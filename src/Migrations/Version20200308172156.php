<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308172156 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mods_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mods ADD mod_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FA4ACE566C FOREIGN KEY (mod_category_id) REFERENCES mods_category (id)');
        $this->addSql('CREATE INDEX IDX_631EF2FA4ACE566C ON mods (mod_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FA4ACE566C');
        $this->addSql('DROP TABLE mods_category');
        $this->addSql('DROP INDEX IDX_631EF2FA4ACE566C ON mods');
        $this->addSql('ALTER TABLE mods DROP mod_category_id');
    }
}
