<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307141017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD commentaire VARCHAR(255) NOT NULL, DROP validation, DROP statut, DROP suivi, DROP montant');
        $this->addSql('ALTER TABLE ligne_commande ADD methode VARCHAR(50) NOT NULL, ADD quantite BIGINT NOT NULL, ADD commentaire VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD commande_id INT DEFAULT NULL, ADD paiement_commande_id INT DEFAULT NULL, CHANGE pods_en_gramme poids_en_gramme BIGINT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3FC11326 FOREIGN KEY (paiement_commande_id) REFERENCES paiement_commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F82EA2E54 ON livraison (commande_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F3FC11326 ON livraison (paiement_commande_id)');
        $this->addSql('ALTER TABLE users ADD email VARCHAR(50) NOT NULL, ADD code_postale BIGINT NOT NULL, ADD pays VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD validation VARCHAR(50) NOT NULL, ADD statut VARCHAR(50) NOT NULL, ADD suivi VARCHAR(50) NOT NULL, ADD montant NUMERIC(10, 2) NOT NULL, DROP commentaire');
        $this->addSql('ALTER TABLE ligne_commande DROP methode, DROP quantite, DROP commentaire');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F3FC11326');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F82EA2E54 ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F3FC11326 ON livraison');
        $this->addSql('ALTER TABLE livraison DROP commande_id, DROP paiement_commande_id, CHANGE poids_en_gramme pods_en_gramme BIGINT NOT NULL');
        $this->addSql('ALTER TABLE users DROP email, DROP code_postale, DROP pays');
    }
}
