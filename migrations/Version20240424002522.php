<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424002522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attach_file (name VARCHAR(64) NOT NULL, secure VARCHAR(18) NOT NULL, folder VARCHAR(64) DEFAULT NULL, attach_directory VARCHAR(24) DEFAULT NULL, id INT AUTO_INCREMENT NOT NULL, UNIQUE INDEX UNIQ_FD10855336DE5A04 (secure), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE producto ADD foto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06157ABFA656 FOREIGN KEY (foto_id) REFERENCES attach_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7BB06157ABFA656 ON producto (foto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE attach_file');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06157ABFA656');
        $this->addSql('DROP INDEX UNIQ_A7BB06157ABFA656 ON producto');
        $this->addSql('ALTER TABLE producto DROP foto_id');
    }
}
