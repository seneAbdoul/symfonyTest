<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320150916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299AFC2B591');
        $this->addSql('DROP INDEX IDX_17A55299AFC2B591 ON professeur');
        $this->addSql('ALTER TABLE professeur DROP module_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professeur ADD module_id INT NOT NULL');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_17A55299AFC2B591 ON professeur (module_id)');
    }
}
