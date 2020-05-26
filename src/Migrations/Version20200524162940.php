<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200524162940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE viande ADD typeanimal_id INT NOT NULL');
        $this->addSql('ALTER TABLE viande ADD CONSTRAINT FK_501177B6DA94E8A FOREIGN KEY (typeanimal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_501177B6DA94E8A ON viande (typeanimal_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE viande DROP FOREIGN KEY FK_501177B6DA94E8A');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP INDEX IDX_501177B6DA94E8A ON viande');
        $this->addSql('ALTER TABLE viande DROP typeanimal_id');
    }
}
