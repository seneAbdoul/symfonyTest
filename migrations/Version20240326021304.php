<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326021304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE absence (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, cour_id INT DEFAULT NULL, date_absence DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_765AE0C9DDEAB1A3 (etudiant_id), INDEX IDX_765AE0C9B7942F03 (cour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annee_scolaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, etat VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, niveau_id INT DEFAULT NULL, cour_id INT NOT NULL, libelle VARCHAR(25) NOT NULL, INDEX IDX_8F87BF96180AA129 (filiere_id), INDEX IDX_8F87BF96B3E9C81 (niveau_id), INDEX IDX_8F87BF96B7942F03 (cour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_professeur (id INT AUTO_INCREMENT NOT NULL, annee_scolaire_id INT NOT NULL, classe_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_B29EB3B29331C741 (annee_scolaire_id), INDEX IDX_B29EB3B28F5EA509 (classe_id), INDEX IDX_B29EB3B2BAB22EE9 (professeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, matricule VARCHAR(25) NOT NULL, tuteur VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_cours (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, cour_id INT DEFAULT NULL, INDEX IDX_82F0A080DDEAB1A3 (etudiant_id), INDEX IDX_82F0A080B7942F03 (cour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, classe_id INT NOT NULL, annee_scolaire_id INT NOT NULL, INDEX IDX_5E90F6D6DDEAB1A3 (etudiant_id), INDEX IDX_5E90F6D68F5EA509 (classe_id), INDEX IDX_5E90F6D69331C741 (annee_scolaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planification (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, professeur_id INT DEFAULT NULL, date_planification DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', heure_debut TIME DEFAULT NULL COMMENT \'(DC2Type:time_immutable)\', heure_fin TIME DEFAULT NULL COMMENT \'(DC2Type:time_immutable)\', nombre_heure INT NOT NULL, semestre VARCHAR(25) NOT NULL, heure_fait INT NOT NULL, INDEX IDX_FFC02E1BAFC2B591 (module_id), INDEX IDX_FFC02E1BBAB22EE9 (professeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planification_classe (planification_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_19DB1A4DE65142C2 (planification_id), INDEX IDX_19DB1A4D8F5EA509 (classe_id), PRIMARY KEY(planification_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT NOT NULL, grade VARCHAR(25) NOT NULL, cni VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, date_ajouter_user DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9B7942F03 FOREIGN KEY (cour_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B7942F03 FOREIGN KEY (cour_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE classe_professeur ADD CONSTRAINT FK_B29EB3B29331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE classe_professeur ADD CONSTRAINT FK_B29EB3B28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE classe_professeur ADD CONSTRAINT FK_B29EB3B2BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_cours ADD CONSTRAINT FK_82F0A080DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE etudiant_cours ADD CONSTRAINT FK_82F0A080B7942F03 FOREIGN KEY (cour_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D68F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1BAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1BBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE planification_classe ADD CONSTRAINT FK_19DB1A4DE65142C2 FOREIGN KEY (planification_id) REFERENCES planification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planification_classe ADD CONSTRAINT FK_19DB1A4D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C9DDEAB1A3');
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C9B7942F03');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96180AA129');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96B3E9C81');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96B7942F03');
        $this->addSql('ALTER TABLE classe_professeur DROP FOREIGN KEY FK_B29EB3B29331C741');
        $this->addSql('ALTER TABLE classe_professeur DROP FOREIGN KEY FK_B29EB3B28F5EA509');
        $this->addSql('ALTER TABLE classe_professeur DROP FOREIGN KEY FK_B29EB3B2BAB22EE9');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3BF396750');
        $this->addSql('ALTER TABLE etudiant_cours DROP FOREIGN KEY FK_82F0A080DDEAB1A3');
        $this->addSql('ALTER TABLE etudiant_cours DROP FOREIGN KEY FK_82F0A080B7942F03');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DDEAB1A3');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D68F5EA509');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69331C741');
        $this->addSql('ALTER TABLE planification DROP FOREIGN KEY FK_FFC02E1BAFC2B591');
        $this->addSql('ALTER TABLE planification DROP FOREIGN KEY FK_FFC02E1BBAB22EE9');
        $this->addSql('ALTER TABLE planification_classe DROP FOREIGN KEY FK_19DB1A4DE65142C2');
        $this->addSql('ALTER TABLE planification_classe DROP FOREIGN KEY FK_19DB1A4D8F5EA509');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299BF396750');
        $this->addSql('DROP TABLE absence');
        $this->addSql('DROP TABLE annee_scolaire');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_professeur');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE etudiant_cours');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE planification');
        $this->addSql('DROP TABLE planification_classe');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE user');
    }
}
