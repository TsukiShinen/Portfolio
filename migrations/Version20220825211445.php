<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825211445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(4096) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience_experiences_categories (experience_id INT NOT NULL, experiences_categories_id INT NOT NULL, INDEX IDX_9839CF8446E90E27 (experience_id), INDEX IDX_9839CF84DE7DF9AD (experiences_categories_id), PRIMARY KEY(experience_id, experiences_categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiences_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(4096) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_projects_categories (projects_id INT NOT NULL, projects_categories_id INT NOT NULL, INDEX IDX_7610E5D81EDE0F55 (projects_id), INDEX IDX_7610E5D829C5F741 (projects_categories_id), PRIMARY KEY(projects_id, projects_categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_experiences_categories ADD CONSTRAINT FK_9839CF8446E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_experiences_categories ADD CONSTRAINT FK_9839CF84DE7DF9AD FOREIGN KEY (experiences_categories_id) REFERENCES experiences_categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_projects_categories ADD CONSTRAINT FK_7610E5D81EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_projects_categories ADD CONSTRAINT FK_7610E5D829C5F741 FOREIGN KEY (projects_categories_id) REFERENCES projects_categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience_experiences_categories DROP FOREIGN KEY FK_9839CF8446E90E27');
        $this->addSql('ALTER TABLE experience_experiences_categories DROP FOREIGN KEY FK_9839CF84DE7DF9AD');
        $this->addSql('ALTER TABLE projects_projects_categories DROP FOREIGN KEY FK_7610E5D81EDE0F55');
        $this->addSql('ALTER TABLE projects_projects_categories DROP FOREIGN KEY FK_7610E5D829C5F741');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experience_experiences_categories');
        $this->addSql('DROP TABLE experiences_categories');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE projects_projects_categories');
        $this->addSql('DROP TABLE projects_categories');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
