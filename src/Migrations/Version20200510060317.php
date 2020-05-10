<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200510060317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_post (id INT NOT NULL, category_id INT DEFAULT NULL, publish_at DATETIME DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, deprecated VARCHAR(255) DEFAULT NULL, is_depre TINYINT(1) NOT NULL, INDEX IDX_BA5AE01D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, is_online TINYINT(1) NOT NULL, is_news TINYINT(1) NOT NULL, is_info TINYINT(1) NOT NULL, info VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_FEC530A9F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupes (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, priority INT NOT NULL, color VARCHAR(25) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_576366D9F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupes_user (groupes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F575AD4F305371B (groupes_id), INDEX IDX_F575AD4FA76ED395 (user_id), PRIMARY KEY(groupes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_category (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, is_online TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_72113DE6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, accepted_at DATETIME DEFAULT NULL, term TINYINT(1) NOT NULL, avatar_name VARCHAR(255) DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, whatsapp VARCHAR(255) DEFAULT NULL, twitch VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_tag (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, color VARCHAR(255) DEFAULT NULL, INDEX IDX_EEA7C17E727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_message (id INT AUTO_INCREMENT NOT NULL, topic_id INT NOT NULL, author_id INT NOT NULL, accepted TINYINT(1) DEFAULT \'0\' NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, spam TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_47717D0E1F55203D (topic_id), INDEX IDX_47717D0EF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_topic (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, last_message_id INT DEFAULT NULL, name VARCHAR(70) NOT NULL, content LONGTEXT NOT NULL, solved TINYINT(1) DEFAULT \'0\' NOT NULL, sticky TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, message_count INT DEFAULT 0 NOT NULL, spam TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_853478CCF675F31B (author_id), INDEX IDX_853478CCBA0E79C3 (last_message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_topic_tag (topic_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E6342771F55203D (topic_id), INDEX IDX_E634277BAD26311 (tag_id), PRIMARY KEY(topic_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_episodes (id INT NOT NULL, duration SMALLINT NOT NULL, youtube_id VARCHAR(150) DEFAULT NULL, video_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, file_size INT UNSIGNED NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D12469DE2 FOREIGN KEY (category_id) REFERENCES blog_category (id)');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DBF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groupes ADD CONSTRAINT FK_576366D9F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groupes_user ADD CONSTRAINT FK_F575AD4F305371B FOREIGN KEY (groupes_id) REFERENCES groupes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupes_user ADD CONSTRAINT FK_F575AD4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_tag ADD CONSTRAINT FK_EEA7C17E727ACA70 FOREIGN KEY (parent_id) REFERENCES forum_tag (id)');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0E1F55203D FOREIGN KEY (topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0EF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCBA0E79C3 FOREIGN KEY (last_message_id) REFERENCES forum_message (id)');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E6342771F55203D FOREIGN KEY (topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E634277BAD26311 FOREIGN KEY (tag_id) REFERENCES forum_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_episodes ADD CONSTRAINT FK_D5576C61BF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01DBF396750');
        $this->addSql('ALTER TABLE video_episodes DROP FOREIGN KEY FK_D5576C61BF396750');
        $this->addSql('ALTER TABLE groupes_user DROP FOREIGN KEY FK_F575AD4F305371B');
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D12469DE2');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9F675F31B');
        $this->addSql('ALTER TABLE groupes DROP FOREIGN KEY FK_576366D9F675F31B');
        $this->addSql('ALTER TABLE groupes_user DROP FOREIGN KEY FK_F575AD4FA76ED395');
        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6F675F31B');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_47717D0EF675F31B');
        $this->addSql('ALTER TABLE forum_topic DROP FOREIGN KEY FK_853478CCF675F31B');
        $this->addSql('ALTER TABLE forum_tag DROP FOREIGN KEY FK_EEA7C17E727ACA70');
        $this->addSql('ALTER TABLE forum_topic_tag DROP FOREIGN KEY FK_E634277BAD26311');
        $this->addSql('ALTER TABLE forum_topic DROP FOREIGN KEY FK_853478CCBA0E79C3');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_47717D0E1F55203D');
        $this->addSql('ALTER TABLE forum_topic_tag DROP FOREIGN KEY FK_E6342771F55203D');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE groupes');
        $this->addSql('DROP TABLE groupes_user');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE forum_tag');
        $this->addSql('DROP TABLE forum_message');
        $this->addSql('DROP TABLE forum_topic');
        $this->addSql('DROP TABLE forum_topic_tag');
        $this->addSql('DROP TABLE video_episodes');
        $this->addSql('DROP TABLE attachment');
    }
}
