<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309162052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_1C52F958B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, is_online TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, shortdesc VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_online TINYINT(1) DEFAULT NULL, is_ok TINYINT(1) DEFAULT NULL, reference VARCHAR(255) DEFAULT NULL, publish_at DATETIME DEFAULT NULL, upnews TINYINT(1) DEFAULT NULL, INDEX IDX_FEC530A912469DE2 (category_id), INDEX IDX_FEC530A9F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_forums (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_E6F169699777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_messages (id INT AUTO_INCREMENT NOT NULL, topic_id_id INT NOT NULL, user_id_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_FCF19371C4773235 (topic_id_id), INDEX IDX_FCF193719D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_topics (id INT AUTO_INCREMENT NOT NULL, forum_id_id INT NOT NULL, user_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, sticky TINYINT(1) DEFAULT NULL, INDEX IDX_895975E867303880 (forum_id_id), INDEX IDX_895975E89D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mods_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mods (id INT AUTO_INCREMENT NOT NULL, testedby_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, mod_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, credit VARCHAR(255) DEFAULT NULL, chevaux VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, option1 VARCHAR(255) DEFAULT NULL, option2 VARCHAR(255) DEFAULT NULL, option3 VARCHAR(255) DEFAULT NULL, certified TINYINT(1) DEFAULT NULL, withouterrors TINYINT(1) DEFAULT NULL, support LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', colorrims TINYINT(1) DEFAULT NULL, colorchoice TINYINT(1) NOT NULL, chargeuravant LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', wheels LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, approuved TINYINT(1) NOT NULL, selection TINYINT(1) DEFAULT NULL, url VARCHAR(255) NOT NULL, istest TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_631EF2FAD5A8C6C4 (testedby_id), INDEX IDX_631EF2FA44F5D008 (brand_id), INDEX IDX_631EF2FA4ACE566C (mod_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, snapshat VARCHAR(255) DEFAULT NULL, real_name VARCHAR(255) DEFAULT NULL, term TINYINT(1) NOT NULL, accept_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE brand ADD CONSTRAINT FK_1C52F958B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_forums ADD CONSTRAINT FK_E6F169699777D11E FOREIGN KEY (category_id_id) REFERENCES forum_category (id)');
        $this->addSql('ALTER TABLE forum_messages ADD CONSTRAINT FK_FCF19371C4773235 FOREIGN KEY (topic_id_id) REFERENCES forum_topics (id)');
        $this->addSql('ALTER TABLE forum_messages ADD CONSTRAINT FK_FCF193719D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E867303880 FOREIGN KEY (forum_id_id) REFERENCES forum_forums (id)');
        $this->addSql('ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FAD5A8C6C4 FOREIGN KEY (testedby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FA44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FA4ACE566C FOREIGN KEY (mod_category_id) REFERENCES mods_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FA44F5D008');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A912469DE2');
        $this->addSql('ALTER TABLE forum_forums DROP FOREIGN KEY FK_E6F169699777D11E');
        $this->addSql('ALTER TABLE forum_topics DROP FOREIGN KEY FK_895975E867303880');
        $this->addSql('ALTER TABLE forum_messages DROP FOREIGN KEY FK_FCF19371C4773235');
        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FA4ACE566C');
        $this->addSql('ALTER TABLE brand DROP FOREIGN KEY FK_1C52F958B03A8386');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9F675F31B');
        $this->addSql('ALTER TABLE forum_messages DROP FOREIGN KEY FK_FCF193719D86650F');
        $this->addSql('ALTER TABLE forum_topics DROP FOREIGN KEY FK_895975E89D86650F');
        $this->addSql('ALTER TABLE mods DROP FOREIGN KEY FK_631EF2FAD5A8C6C4');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE forum_category');
        $this->addSql('DROP TABLE forum_forums');
        $this->addSql('DROP TABLE forum_messages');
        $this->addSql('DROP TABLE forum_topics');
        $this->addSql('DROP TABLE mods_category');
        $this->addSql('DROP TABLE mods');
        $this->addSql('DROP TABLE user');
    }
}
