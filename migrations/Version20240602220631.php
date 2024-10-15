<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602220631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE examen_classe (examen_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_B3E0EFF45C8659A (examen_id), INDEX IDX_B3E0EFF48F5EA509 (classe_id), PRIMARY KEY(examen_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_module (examen_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_3043764A5C8659A (examen_id), INDEX IDX_3043764AAFC2B591 (module_id), PRIMARY KEY(examen_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_professeur (examen_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_EFE5C2465C8659A (examen_id), INDEX IDX_EFE5C246BAB22EE9 (professeur_id), PRIMARY KEY(examen_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_filiere (examen_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_8D503ABA5C8659A (examen_id), INDEX IDX_8D503ABA180AA129 (filiere_id), PRIMARY KEY(examen_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE examen_classe ADD CONSTRAINT FK_B3E0EFF45C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_classe ADD CONSTRAINT FK_B3E0EFF48F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_module ADD CONSTRAINT FK_3043764A5C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_module ADD CONSTRAINT FK_3043764AAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_professeur ADD CONSTRAINT FK_EFE5C2465C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_professeur ADD CONSTRAINT FK_EFE5C246BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_filiere ADD CONSTRAINT FK_8D503ABA5C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_filiere ADD CONSTRAINT FK_8D503ABA180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A552995C8659A');
        $this->addSql('DROP INDEX IDX_17A552995C8659A ON professeur');
        $this->addSql('ALTER TABLE professeur DROP examen_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen_classe DROP FOREIGN KEY FK_B3E0EFF45C8659A');
        $this->addSql('ALTER TABLE examen_classe DROP FOREIGN KEY FK_B3E0EFF48F5EA509');
        $this->addSql('ALTER TABLE examen_module DROP FOREIGN KEY FK_3043764A5C8659A');
        $this->addSql('ALTER TABLE examen_module DROP FOREIGN KEY FK_3043764AAFC2B591');
        $this->addSql('ALTER TABLE examen_professeur DROP FOREIGN KEY FK_EFE5C2465C8659A');
        $this->addSql('ALTER TABLE examen_professeur DROP FOREIGN KEY FK_EFE5C246BAB22EE9');
        $this->addSql('ALTER TABLE examen_filiere DROP FOREIGN KEY FK_8D503ABA5C8659A');
        $this->addSql('ALTER TABLE examen_filiere DROP FOREIGN KEY FK_8D503ABA180AA129');
        $this->addSql('DROP TABLE examen_classe');
        $this->addSql('DROP TABLE examen_module');
        $this->addSql('DROP TABLE examen_professeur');
        $this->addSql('DROP TABLE examen_filiere');
        $this->addSql('ALTER TABLE professeur ADD examen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A552995C8659A FOREIGN KEY (examen_id) REFERENCES examen (id)');
        $this->addSql('CREATE INDEX IDX_17A552995C8659A ON professeur (examen_id)');
    }
}
