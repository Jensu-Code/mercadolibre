<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425174644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto ADD created_att DATETIME DEFAULT NULL, ADD updated_att DATETIME DEFAULT NULL, ADD vendedor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06158361A8B8 FOREIGN KEY (vendedor_id) REFERENCES vendedor (id)');
        $this->addSql('CREATE INDEX IDX_A7BB06158361A8B8 ON producto (vendedor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06158361A8B8');
        $this->addSql('DROP INDEX IDX_A7BB06158361A8B8 ON producto');
        $this->addSql('ALTER TABLE producto DROP created_att, DROP updated_att, DROP vendedor_id');
    }
}
