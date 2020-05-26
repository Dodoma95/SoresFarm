<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526140807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dispose (id INT AUTO_INCREMENT NOT NULL, viande_id INT DEFAULT NULL, farmer_id INT DEFAULT NULL, number INT NOT NULL, INDEX IDX_6262E0664C61F684 (viande_id), INDEX IDX_6262E06613481D2B (farmer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE farmer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dispose ADD CONSTRAINT FK_6262E0664C61F684 FOREIGN KEY (viande_id) REFERENCES viande (id)');
        $this->addSql('ALTER TABLE dispose ADD CONSTRAINT FK_6262E06613481D2B FOREIGN KEY (farmer_id) REFERENCES farmer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dispose DROP FOREIGN KEY FK_6262E06613481D2B');
        $this->addSql('DROP TABLE dispose');
        $this->addSql('DROP TABLE farmer');
    }
}
