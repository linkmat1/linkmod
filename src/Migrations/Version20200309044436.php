<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309044436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE forum_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_forums (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_E6F169699777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_messages (id INT AUTO_INCREMENT NOT NULL, topic_id_id INT NOT NULL, user_id_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_FCF19371C4773235 (topic_id_id), INDEX IDX_FCF193719D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_topics (id INT AUTO_INCREMENT NOT NULL, forum_id_id INT NOT NULL, user_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, sticky TINYINT(1) DEFAULT NULL, INDEX IDX_895975E867303880 (forum_id_id), INDEX IDX_895975E89D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE forum_forums ADD CONSTRAINT FK_E6F169699777D11E FOREIGN KEY (category_id_id) REFERENCES forum_category (id)');
        $this->addSql('ALTER TABLE forum_messages ADD CONSTRAINT FK_FCF19371C4773235 FOREIGN KEY (topic_id_id) REFERENCES forum_topics (id)');
        $this->addSql('ALTER TABLE forum_messages ADD CONSTRAINT FK_FCF193719D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E867303880 FOREIGN KEY (forum_id_id) REFERENCES forum_forums (id)');
        $this->addSql('ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE forum_forums DROP FOREIGN KEY FK_E6F169699777D11E');
        $this->addSql('ALTER TABLE forum_topics DROP FOREIGN KEY FK_895975E867303880');
        $this->addSql('ALTER TABLE forum_messages DROP FOREIGN KEY FK_FCF19371C4773235');
        $this->addSql('DROP TABLE forum_category');
        $this->addSql('DROP TABLE forum_forums');
        $this->addSql('DROP TABLE forum_messages');
        $this->addSql('DROP TABLE forum_topics');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
