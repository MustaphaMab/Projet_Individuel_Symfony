<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320124224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON categorie');
        $this->addSql('ALTER TABLE categorie ADD Id_Categorie INT AUTO_INCREMENT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE categorie ADD PRIMARY KEY (Id_Categorie)');
        $this->addSql('ALTER TABLE commande MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DA76ED395 ON commande');
        $this->addSql('DROP INDEX `primary` ON commande');
        $this->addSql('ALTER TABLE commande CHANGE id Id_Commande INT AUTO_INCREMENT NOT NULL, CHANGE user_id Id_User INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D693C5CE9 FOREIGN KEY (Id_User) REFERENCES user (Id_user)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D693C5CE9 ON commande (Id_User)');
        $this->addSql('ALTER TABLE commande ADD PRIMARY KEY (Id_Commande)');
        $this->addSql('ALTER TABLE ligne_commande MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF347EFB');
        $this->addSql('DROP INDEX IDX_3170B74B82EA2E54 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74BF347EFB ON ligne_commande');
        $this->addSql('DROP INDEX `primary` ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande ADD Id_Commande INT NOT NULL, ADD Id_Produit INT NOT NULL, DROP commande_id, DROP produit_id, CHANGE id Id_Ligne_Commande INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B41DBA769 FOREIGN KEY (Id_Commande) REFERENCES commande (Id_Commande)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B77D87F1B FOREIGN KEY (Id_Produit) REFERENCES produit (Id_Produit)');
        $this->addSql('CREATE INDEX IDX_3170B74B41DBA769 ON ligne_commande (Id_Commande)');
        $this->addSql('CREATE INDEX IDX_3170B74B77D87F1B ON ligne_commande (Id_Produit)');
        $this->addSql('ALTER TABLE ligne_commande ADD PRIMARY KEY (Id_Ligne_Commande)');
        $this->addSql('ALTER TABLE livraison MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F3FC11326');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F82EA2E54 ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F3FC11326 ON livraison');
        $this->addSql('DROP INDEX `primary` ON livraison');
        $this->addSql('ALTER TABLE livraison ADD Id_Commande INT NOT NULL, ADD Id_Paiement_Commande INT NOT NULL, DROP paiement_commande_id, DROP commande_id, CHANGE id Id_Livraison INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F41DBA769 FOREIGN KEY (Id_Commande) REFERENCES commande (Id_Commande)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F985336F7 FOREIGN KEY (Id_Paiement_Commande) REFERENCES paiement_commande (Id_Paiement_Commande)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F41DBA769 ON livraison (Id_Commande)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F985336F7 ON livraison (Id_Paiement_Commande)');
        $this->addSql('ALTER TABLE livraison ADD PRIMARY KEY (Id_Livraison)');
        $this->addSql('ALTER TABLE paiement_commande MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement_commande DROP FOREIGN KEY FK_A44D5E4782EA2E54');
        $this->addSql('DROP INDEX UNIQ_A44D5E4782EA2E54 ON paiement_commande');
        $this->addSql('DROP INDEX `primary` ON paiement_commande');
        $this->addSql('ALTER TABLE paiement_commande ADD Id_Commande INT NOT NULL, DROP commande_id, CHANGE id Id_Paiement_Commande INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement_commande ADD CONSTRAINT FK_A44D5E4741DBA769 FOREIGN KEY (Id_Commande) REFERENCES commande (Id_Commande)');
        $this->addSql('CREATE INDEX IDX_A44D5E4741DBA769 ON paiement_commande (Id_Commande)');
        $this->addSql('ALTER TABLE paiement_commande ADD PRIMARY KEY (Id_Paiement_Commande)');
        $this->addSql('ALTER TABLE produit MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F347EFB');
        $this->addSql('DROP INDEX UNIQ_29A5EC27F347EFB ON produit');
        $this->addSql('DROP INDEX `primary` ON produit');
        $this->addSql('ALTER TABLE produit ADD Id_Categorie INT NOT NULL, DROP produit_id, CHANGE id Id_Produit INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2753883348 FOREIGN KEY (Id_Categorie) REFERENCES categorie (Id_Categorie)');
        $this->addSql('CREATE INDEX IDX_29A5EC2753883348 ON produit (Id_Categorie)');
        $this->addSql('ALTER TABLE produit ADD PRIMARY KEY (Id_Produit)');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON user');
        $this->addSql('ALTER TABLE user CHANGE id Id_user INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (Id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie MODIFY Id_Categorie INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON categorie');
        $this->addSql('ALTER TABLE categorie ADD id INT NOT NULL, DROP Id_Categorie');
        $this->addSql('ALTER TABLE categorie ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE commande MODIFY Id_Commande INT NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D693C5CE9');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D693C5CE9 ON commande');
        $this->addSql('DROP INDEX `PRIMARY` ON commande');
        $this->addSql('ALTER TABLE commande CHANGE Id_Commande id INT AUTO_INCREMENT NOT NULL, CHANGE Id_User user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE commande ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE ligne_commande MODIFY Id_Ligne_Commande INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B41DBA769');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B77D87F1B');
        $this->addSql('DROP INDEX IDX_3170B74B41DBA769 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74B77D87F1B ON ligne_commande');
        $this->addSql('DROP INDEX `PRIMARY` ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande ADD commande_id INT DEFAULT NULL, ADD produit_id INT DEFAULT NULL, DROP Id_Commande, DROP Id_Produit, CHANGE Id_Ligne_Commande id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B82EA2E54 ON ligne_commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_3170B74BF347EFB ON ligne_commande (produit_id)');
        $this->addSql('ALTER TABLE ligne_commande ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE livraison MODIFY Id_Livraison INT NOT NULL');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F41DBA769');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F985336F7');
        $this->addSql('DROP INDEX IDX_A60C9F1F41DBA769 ON livraison');
        $this->addSql('DROP INDEX IDX_A60C9F1F985336F7 ON livraison');
        $this->addSql('DROP INDEX `PRIMARY` ON livraison');
        $this->addSql('ALTER TABLE livraison ADD paiement_commande_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL, DROP Id_Commande, DROP Id_Paiement_Commande, CHANGE Id_Livraison id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3FC11326 FOREIGN KEY (paiement_commande_id) REFERENCES paiement_commande (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F82EA2E54 ON livraison (commande_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F3FC11326 ON livraison (paiement_commande_id)');
        $this->addSql('ALTER TABLE livraison ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE paiement_commande MODIFY Id_Paiement_Commande INT NOT NULL');
        $this->addSql('ALTER TABLE paiement_commande DROP FOREIGN KEY FK_A44D5E4741DBA769');
        $this->addSql('DROP INDEX IDX_A44D5E4741DBA769 ON paiement_commande');
        $this->addSql('DROP INDEX `PRIMARY` ON paiement_commande');
        $this->addSql('ALTER TABLE paiement_commande ADD commande_id INT DEFAULT NULL, DROP Id_Commande, CHANGE Id_Paiement_Commande id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement_commande ADD CONSTRAINT FK_A44D5E4782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A44D5E4782EA2E54 ON paiement_commande (commande_id)');
        $this->addSql('ALTER TABLE paiement_commande ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE produit MODIFY Id_Produit INT NOT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2753883348');
        $this->addSql('DROP INDEX IDX_29A5EC2753883348 ON produit');
        $this->addSql('DROP INDEX `PRIMARY` ON produit');
        $this->addSql('ALTER TABLE produit ADD produit_id INT DEFAULT NULL, DROP Id_Categorie, CHANGE Id_Produit id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F347EFB FOREIGN KEY (produit_id) REFERENCES categorie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC27F347EFB ON produit (produit_id)');
        $this->addSql('ALTER TABLE produit ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user MODIFY Id_user INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON user');
        $this->addSql('ALTER TABLE user CHANGE Id_user id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id)');
    }
}
