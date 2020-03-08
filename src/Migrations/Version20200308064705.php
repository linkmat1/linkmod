<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308064705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mods ADD testedby_id INT DEFAULT NULL, ADD author_id INT DEFAULT NULL, ADD istest TINYINT(1) DEFAULT NULL, CHANGE approuved approuved TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FAD5A8C6C4 FOREIGN KEY (testedby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FAF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_631EF2FAD5A8C6C4 ON mods (testedby_id)');
        $this->addSql('CREATE INDEX IDX_631EF2FAF675F31B ON mods (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FAD5A8C6C4');
        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FAF675F31B');
        $this->addSql('DROP INDEX IDX_631EF2FAD5A8C6C4 ON mods');
        $this->addSql('DROP INDEX IDX_631EF2FAF675F31B ON mods');
        $this->addSql('ALTER TABLE mods DROP testedby_id, DROP author_id, DROP istest, CHANGE approuved approuved TINYINT(1) DEFAULT NULL');
    }
}
