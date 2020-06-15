<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615065956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE options options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE dispose CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL, CHANGE fruit_id fruit_id INT DEFAULT NULL, CHANGE legume_id legume_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_abonnement CHANGE user_id user_id INT DEFAULT NULL, CHANGE abonnement_id abonnement_id INT DEFAULT NULL, CHANGE options options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE `option`');
        $this->addSql('ALTER TABLE abonnement CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE options options LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE dispose CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE fruit_id fruit_id INT DEFAULT NULL, CHANGE legume_id legume_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_abonnement CHANGE user_id user_id INT DEFAULT NULL, CHANGE abonnement_id abonnement_id INT DEFAULT NULL, CHANGE options options LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
