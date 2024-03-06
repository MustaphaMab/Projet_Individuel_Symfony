<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304211814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C9047539');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9C9047539');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF77D927C');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, id_commmande_id INT NOT NULL, produit_id INT NOT NULL, ligne_commande BIGINT NOT NULL, prix_total NUMERIC(10, 2) NOT NULL, INDEX IDX_3170B74BE05AD0A7 (id_commmande_id), INDEX IDX_3170B74BF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BE05AD0A7 FOREIGN KEY (id_commmande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF267B3B43D');
        $this->addSql('DROP TABLE gestion_stock');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP INDEX IDX_6EEAA67DF77D927C ON commande');
        $this->addSql('ALTER TABLE commande DROP panier_id');
        $this->addSql('DROP INDEX IDX_29A5EC27C9047539 ON produit');
        $this->addSql('ALTER TABLE produit DROP gestion_stock_id');
        $this->addSql('DROP INDEX IDX_1483A5E9C9047539 ON users');
        $this->addSql('ALTER TABLE users DROP gestion_stock_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gestion_stock (id INT AUTO_INCREMENT NOT NULL, quantite_entree BIGINT NOT NULL, quantitee_sortie BIGINT NOT NULL, date_creation DATE NOT NULL, commentaires VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, montant BIGINT NOT NULL, UNIQUE INDEX UNIQ_24CC0DF267B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BE05AD0A7');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF347EFB');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('ALTER TABLE commande ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DF77D927C ON commande (panier_id)');
        $this->addSql('ALTER TABLE produit ADD gestion_stock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C9047539 FOREIGN KEY (gestion_stock_id) REFERENCES gestion_stock (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27C9047539 ON produit (gestion_stock_id)');
        $this->addSql('ALTER TABLE users ADD gestion_stock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9C9047539 FOREIGN KEY (gestion_stock_id) REFERENCES gestion_stock (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9C9047539 ON users (gestion_stock_id)');
    }
}
