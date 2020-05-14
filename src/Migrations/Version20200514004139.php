<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514004139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE attachment (id SERIAL NOT NULL, file_name VARCHAR(255) NOT NULL, file_size INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE blog_category (id SERIAL NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, content TEXT DEFAULT NULL, is_online BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_72113DE6F675F31B ON blog_category (author_id)');
        $this->addSql('CREATE TABLE content (id SERIAL NOT NULL, author_id INT DEFAULT NULL, attachment_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content TEXT DEFAULT NULL, is_online BOOLEAN NOT NULL, is_news BOOLEAN NOT NULL, is_info BOOLEAN NOT NULL, info VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEC530A9F675F31B ON content (author_id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9464E68B ON content (attachment_id)');
        $this->addSql('CREATE TABLE video_episodes (id INT NOT NULL, duration SMALLINT NOT NULL, youtube_id VARCHAR(150) DEFAULT NULL, video_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE forum_message (id SERIAL NOT NULL, topic_id INT NOT NULL, author_id INT NOT NULL, accepted BOOLEAN DEFAULT \'false\' NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, spam BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47717D0E1F55203D ON forum_message (topic_id)');
        $this->addSql('CREATE INDEX IDX_47717D0EF675F31B ON forum_message (author_id)');
        $this->addSql('CREATE TABLE forum_report (id SERIAL NOT NULL, author_id INT NOT NULL, topic_id INT DEFAULT NULL, message_id INT DEFAULT NULL, reason VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC804455F675F31B ON forum_report (author_id)');
        $this->addSql('CREATE INDEX IDX_DC8044551F55203D ON forum_report (topic_id)');
        $this->addSql('CREATE INDEX IDX_DC804455537A1329 ON forum_report (message_id)');
        $this->addSql('CREATE TABLE forum_tag (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EEA7C17E727ACA70 ON forum_tag (parent_id)');
        $this->addSql('CREATE TABLE forum_topic (id SERIAL NOT NULL, author_id INT NOT NULL, last_message_id INT DEFAULT NULL, name VARCHAR(70) NOT NULL, content TEXT NOT NULL, solved BOOLEAN DEFAULT \'false\' NOT NULL, sticky BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, message_count INT DEFAULT 0 NOT NULL, spam BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_853478CCF675F31B ON forum_topic (author_id)');
        $this->addSql('CREATE INDEX IDX_853478CCBA0E79C3 ON forum_topic (last_message_id)');
        $this->addSql('CREATE TABLE forum_topic_tag (topic_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(topic_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_E6342771F55203D ON forum_topic_tag (topic_id)');
        $this->addSql('CREATE INDEX IDX_E634277BAD26311 ON forum_topic_tag (tag_id)');
        $this->addSql('CREATE TABLE blog_post (id INT NOT NULL, category_id INT DEFAULT NULL, publish_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, deprecated VARCHAR(255) DEFAULT NULL, is_depre BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA5AE01D12469DE2 ON blog_post (category_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, accepted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, term BOOLEAN NOT NULL, avatar_name VARCHAR(255) DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, whatsapp VARCHAR(255) DEFAULT NULL, twitch VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9464E68B FOREIGN KEY (attachment_id) REFERENCES attachment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video_episodes ADD CONSTRAINT FK_D5576C61BF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0E1F55203D FOREIGN KEY (topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT FK_47717D0EF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_report ADD CONSTRAINT FK_DC804455F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_report ADD CONSTRAINT FK_DC8044551F55203D FOREIGN KEY (topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_report ADD CONSTRAINT FK_DC804455537A1329 FOREIGN KEY (message_id) REFERENCES forum_message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_tag ADD CONSTRAINT FK_EEA7C17E727ACA70 FOREIGN KEY (parent_id) REFERENCES forum_tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic ADD CONSTRAINT FK_853478CCBA0E79C3 FOREIGN KEY (last_message_id) REFERENCES forum_message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E6342771F55203D FOREIGN KEY (topic_id) REFERENCES forum_topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum_topic_tag ADD CONSTRAINT FK_E634277BAD26311 FOREIGN KEY (tag_id) REFERENCES forum_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D12469DE2 FOREIGN KEY (category_id) REFERENCES blog_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DBF396750 FOREIGN KEY (id) REFERENCES content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE content DROP CONSTRAINT FK_FEC530A9464E68B');
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT FK_BA5AE01D12469DE2');
        $this->addSql('ALTER TABLE video_episodes DROP CONSTRAINT FK_D5576C61BF396750');
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT FK_BA5AE01DBF396750');
        $this->addSql('ALTER TABLE forum_report DROP CONSTRAINT FK_DC804455537A1329');
        $this->addSql('ALTER TABLE forum_topic DROP CONSTRAINT FK_853478CCBA0E79C3');
        $this->addSql('ALTER TABLE forum_tag DROP CONSTRAINT FK_EEA7C17E727ACA70');
        $this->addSql('ALTER TABLE forum_topic_tag DROP CONSTRAINT FK_E634277BAD26311');
        $this->addSql('ALTER TABLE forum_message DROP CONSTRAINT FK_47717D0E1F55203D');
        $this->addSql('ALTER TABLE forum_report DROP CONSTRAINT FK_DC8044551F55203D');
        $this->addSql('ALTER TABLE forum_topic_tag DROP CONSTRAINT FK_E6342771F55203D');
        $this->addSql('ALTER TABLE blog_category DROP CONSTRAINT FK_72113DE6F675F31B');
        $this->addSql('ALTER TABLE content DROP CONSTRAINT FK_FEC530A9F675F31B');
        $this->addSql('ALTER TABLE forum_message DROP CONSTRAINT FK_47717D0EF675F31B');
        $this->addSql('ALTER TABLE forum_report DROP CONSTRAINT FK_DC804455F675F31B');
        $this->addSql('ALTER TABLE forum_topic DROP CONSTRAINT FK_853478CCF675F31B');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE video_episodes');
        $this->addSql('DROP TABLE forum_message');
        $this->addSql('DROP TABLE forum_report');
        $this->addSql('DROP TABLE forum_tag');
        $this->addSql('DROP TABLE forum_topic');
        $this->addSql('DROP TABLE forum_topic_tag');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE "user"');
    }
}
