<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303131145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(300) NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, validation VARCHAR(50) NOT NULL, statut VARCHAR(50) NOT NULL, date BIGINT NOT NULL, suivi VARCHAR(50) NOT NULL, montant NUMERIC(10, 2) NOT NULL, INDEX IDX_6EEAA67DF77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestion_stock (id INT AUTO_INCREMENT NOT NULL, quantite_entree BIGINT NOT NULL, quantitee_sortie BIGINT NOT NULL, date_creation DATE NOT NULL, commentaires VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, numero_suivi VARCHAR(50) NOT NULL, frais_livraison NUMERIC(10, 2) NOT NULL, transporteur VARCHAR(50) NOT NULL, pods_en_gramme BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, montant NUMERIC(10, 2) NOT NULL, methode VARCHAR(50) NOT NULL, statut VARCHAR(50) NOT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_A44D5E4782EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, montant BIGINT NOT NULL, UNIQUE INDEX UNIQ_24CC0DF267B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, gestion_stock_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, stock BIGINT NOT NULL, description VARCHAR(300) NOT NULL, photo VARCHAR(300) NOT NULL, prix NUMERIC(10, 2) NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), INDEX IDX_29A5EC27C9047539 (gestion_stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, gestion_stock_id INT DEFAULT NULL, role VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, md_p VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, telephone BIGINT NOT NULL, adresse VARCHAR(255) NOT NULL, INDEX IDX_1483A5E9C9047539 (gestion_stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE paiement_commande ADD CONSTRAINT FK_A44D5E4782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C9047539 FOREIGN KEY (gestion_stock_id) REFERENCES gestion_stock (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9C9047539 FOREIGN KEY (gestion_stock_id) REFERENCES gestion_stock (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF77D927C');
        $this->addSql('ALTER TABLE paiement_commande DROP FOREIGN KEY FK_A44D5E4782EA2E54');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF267B3B43D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C9047539');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9C9047539');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE gestion_stock');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE paiement_commande');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
