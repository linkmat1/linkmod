<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515213122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_category ADD color VARCHAR(100) DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE content CHANGE author_id author_id INT DEFAULT NULL, CHANGE attachment_id attachment_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE info info VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE video_episodes CHANGE youtube_id youtube_id VARCHAR(150) DEFAULT NULL, CHANGE video_path video_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE forum_report CHANGE topic_id topic_id INT DEFAULT NULL, CHANGE message_id message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE forum_tag CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE position position INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE color color VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE forum_topic CHANGE last_message_id last_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_post CHANGE category_id category_id INT DEFAULT NULL, CHANGE publish_at publish_at DATETIME DEFAULT NULL, CHANGE source source VARCHAR(255) DEFAULT NULL, CHANGE deprecated deprecated VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE accepted_at accepted_at DATETIME DEFAULT NULL, CHANGE avatar_name avatar_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_category DROP color, CHANGE author_id author_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE blog_post CHANGE category_id category_id INT DEFAULT NULL, CHANGE publish_at publish_at DATETIME DEFAULT \'NULL\', CHANGE source source VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE deprecated deprecated VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE content CHANGE author_id author_id INT DEFAULT NULL, CHANGE attachment_id attachment_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE info info VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE forum_report CHANGE topic_id topic_id INT DEFAULT NULL, CHANGE message_id message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE forum_tag CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE position position INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE color color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE forum_topic CHANGE last_message_id last_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE accepted_at accepted_at DATETIME DEFAULT \'NULL\', CHANGE avatar_name avatar_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE video_episodes CHANGE youtube_id youtube_id VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE video_path video_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
