<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816114906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, iduser_id INT DEFAULT NULL, idtype_id INT DEFAULT NULL, agence VARCHAR(255) DEFAULT NULL, somme INT DEFAULT NULL, frais INT DEFAULT NULL, datetran DATETIME DEFAULT NULL, code INT DEFAULT NULL, nomcomplet VARCHAR(255) DEFAULT NULL, nomcompletben VARCHAR(255) DEFAULT NULL, tel INT DEFAULT NULL, cni INT DEFAULT NULL, INDEX IDX_723705D1786A81FB (iduser_id), INDEX IDX_723705D11A48DEFD (idtype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D11A48DEFD FOREIGN KEY (idtype_id) REFERENCES type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transaction');
    }
}
