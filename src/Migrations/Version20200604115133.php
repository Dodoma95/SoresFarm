<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604115133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_abonnement (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, abonnement_id INT DEFAULT NULL, options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, state LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_9275AE57A76ED395 (user_id), INDEX IDX_9275AE57F1D74413 (abonnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) DEFAULT NULL, options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_abonnement ADD CONSTRAINT FK_9275AE57A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_abonnement ADD CONSTRAINT FK_9275AE57F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE dispose CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL, CHANGE fruit_id fruit_id INT DEFAULT NULL, CHANGE legume_id legume_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_abonnement DROP FOREIGN KEY FK_9275AE57F1D74413');
        $this->addSql('DROP TABLE user_abonnement');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('ALTER TABLE dispose CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE fruit_id fruit_id INT DEFAULT NULL, CHANGE legume_id legume_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP email, DROP created_at, DROP updated_at');
    }
}
