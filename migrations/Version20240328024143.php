<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328024143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe_planification (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, planification_id INT DEFAULT NULL, nombre_heure INT NOT NULL, heure_fait INT NOT NULL, INDEX IDX_3DB6AC368F5EA509 (classe_id), INDEX IDX_3DB6AC36E65142C2 (planification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_planification ADD CONSTRAINT FK_3DB6AC368F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE classe_planification ADD CONSTRAINT FK_3DB6AC36E65142C2 FOREIGN KEY (planification_id) REFERENCES planification (id)');
        $this->addSql('ALTER TABLE planification DROP nombre_heure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_planification DROP FOREIGN KEY FK_3DB6AC368F5EA509');
        $this->addSql('ALTER TABLE classe_planification DROP FOREIGN KEY FK_3DB6AC36E65142C2');
        $this->addSql('DROP TABLE classe_planification');
        $this->addSql('ALTER TABLE planification ADD nombre_heure INT NOT NULL');
    }
}
