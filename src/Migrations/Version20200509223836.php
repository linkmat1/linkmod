<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509223836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE groupes (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, priority INT NOT NULL, INDEX IDX_576366D9F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupes_user (groupes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F575AD4F305371B (groupes_id), INDEX IDX_F575AD4FA76ED395 (user_id), PRIMARY KEY(groupes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupes ADD CONSTRAINT FK_576366D9F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groupes_user ADD CONSTRAINT FK_F575AD4F305371B FOREIGN KEY (groupes_id) REFERENCES groupes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupes_user ADD CONSTRAINT FK_F575AD4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groupes_user DROP FOREIGN KEY FK_F575AD4F305371B');
        $this->addSql('DROP TABLE groupes');
        $this->addSql('DROP TABLE groupes_user');
    }
}
