<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220914154851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_image (project_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_D6680DC1166D1F9C (project_id), INDEX IDX_D6680DC13DA5256D (image_id), PRIMARY KEY(project_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC13DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exp DROP icon');
        $this->addSql('ALTER TABLE project ADD image_id INT DEFAULT NULL, DROP image, DROP other_images');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE3DA5256D ON project (image_id)');
        $this->addSql('ALTER TABLE skill ADD icon_id INT DEFAULT NULL, DROP icon');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47754B9D732 FOREIGN KEY (icon_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE47754B9D732 ON skill (icon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE3DA5256D');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47754B9D732');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC1166D1F9C');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC13DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE project_image');
        $this->addSql('ALTER TABLE exp ADD icon VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_2FB3D0EE3DA5256D ON project');
        $this->addSql('ALTER TABLE project ADD image VARCHAR(255) NOT NULL, ADD other_images VARCHAR(255) NOT NULL, DROP image_id');
        $this->addSql('DROP INDEX IDX_5E3DE47754B9D732 ON skill');
        $this->addSql('ALTER TABLE skill ADD icon VARCHAR(255) DEFAULT NULL, DROP icon_id');
    }
}
