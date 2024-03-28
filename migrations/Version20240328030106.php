<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328030106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planification ADD cour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1BB7942F03 FOREIGN KEY (cour_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_FFC02E1BB7942F03 ON planification (cour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planification DROP FOREIGN KEY FK_FFC02E1BB7942F03');
        $this->addSql('DROP INDEX IDX_FFC02E1BB7942F03 ON planification');
        $this->addSql('ALTER TABLE planification DROP cour_id');
    }
}
