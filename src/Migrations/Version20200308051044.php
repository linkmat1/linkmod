<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308051044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mods (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, credit VARCHAR(255) DEFAULT NULL, chevaux VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, option1 VARCHAR(255) DEFAULT NULL, option2 VARCHAR(255) DEFAULT NULL, option3 VARCHAR(255) DEFAULT NULL, certified TINYINT(1) DEFAULT NULL, withouterrors TINYINT(1) NOT NULL, support LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', colorrims TINYINT(1) DEFAULT NULL, colorchoice TINYINT(1) NOT NULL, chargeuravant LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', wheels LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mods');
    }
}
