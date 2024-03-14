<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314143025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement_commande ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement_commande ADD CONSTRAINT FK_A44D5E4782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A44D5E4782EA2E54 ON paiement_commande (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement_commande DROP FOREIGN KEY FK_A44D5E4782EA2E54');
        $this->addSql('DROP INDEX UNIQ_A44D5E4782EA2E54 ON paiement_commande');
        $this->addSql('ALTER TABLE paiement_commande DROP commande_id');
    }
}
