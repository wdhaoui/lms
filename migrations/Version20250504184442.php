<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250504184442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE lms_courses (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN lms_courses.created_at IS '(DC2Type:datetimetz_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE lms_learning_path_courses (course_id INT NOT NULL, learning_path_id INT NOT NULL, PRIMARY KEY(course_id, learning_path_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9321A649591CC992 ON lms_learning_path_courses (course_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9321A6491DCBEE98 ON lms_learning_path_courses (learning_path_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE lms_learning_paths (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, objectives TEXT DEFAULT NULL, visibility SMALLINT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN lms_learning_paths.created_at IS '(DC2Type:datetimetz_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lms_learning_path_courses ADD CONSTRAINT FK_9321A649591CC992 FOREIGN KEY (course_id) REFERENCES lms_courses (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lms_learning_path_courses ADD CONSTRAINT FK_9321A6491DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES lms_learning_paths (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lms_learning_path_courses DROP CONSTRAINT FK_9321A649591CC992
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lms_learning_path_courses DROP CONSTRAINT FK_9321A6491DCBEE98
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lms_courses
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lms_learning_path_courses
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lms_learning_paths
        SQL);
    }
}
