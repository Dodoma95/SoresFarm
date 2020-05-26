<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526160453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE legume (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, origin VARCHAR(255) NOT NULL, skill LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fruit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, origin VARCHAR(255) NOT NULL, skill LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dispose ADD fruit_id INT DEFAULT NULL, ADD legume_id INT DEFAULT NULL, CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dispose ADD CONSTRAINT FK_6262E066BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE dispose ADD CONSTRAINT FK_6262E06625F18E37 FOREIGN KEY (legume_id) REFERENCES legume (id)');
        $this->addSql('CREATE INDEX IDX_6262E066BAC115F0 ON dispose (fruit_id)');
        $this->addSql('CREATE INDEX IDX_6262E06625F18E37 ON dispose (legume_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dispose DROP FOREIGN KEY FK_6262E06625F18E37');
        $this->addSql('ALTER TABLE dispose DROP FOREIGN KEY FK_6262E066BAC115F0');
        $this->addSql('DROP TABLE legume');
        $this->addSql('DROP TABLE fruit');
        $this->addSql('DROP INDEX IDX_6262E066BAC115F0 ON dispose');
        $this->addSql('DROP INDEX IDX_6262E06625F18E37 ON dispose');
        $this->addSql('ALTER TABLE dispose DROP fruit_id, DROP legume_id, CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL');
    }
}
