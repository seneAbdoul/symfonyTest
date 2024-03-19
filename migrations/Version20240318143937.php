<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318143937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_scolaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, etat VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, niveau_id INT NOT NULL, classe_id INT DEFAULT NULL, libelle VARCHAR(25) NOT NULL, INDEX IDX_8F87BF96180AA129 (filiere_id), INDEX IDX_8F87BF96B3E9C81 (niveau_id), INDEX IDX_8F87BF968F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_professeur (id INT AUTO_INCREMENT NOT NULL, professeur_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, annee_scolaire_id INT DEFAULT NULL, INDEX IDX_B29EB3B2BAB22EE9 (professeur_id), INDEX IDX_B29EB3B28F5EA509 (classe_id), INDEX IDX_B29EB3B29331C741 (annee_scolaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, grade VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF968F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE classe_professeur ADD CONSTRAINT FK_B29EB3B2BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE classe_professeur ADD CONSTRAINT FK_B29EB3B28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE classe_professeur ADD CONSTRAINT FK_B29EB3B29331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96180AA129');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96B3E9C81');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF968F5EA509');
        $this->addSql('ALTER TABLE classe_professeur DROP FOREIGN KEY FK_B29EB3B2BAB22EE9');
        $this->addSql('ALTER TABLE classe_professeur DROP FOREIGN KEY FK_B29EB3B28F5EA509');
        $this->addSql('ALTER TABLE classe_professeur DROP FOREIGN KEY FK_B29EB3B29331C741');
        $this->addSql('DROP TABLE annee_scolaire');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_professeur');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE professeur');
    }
}
