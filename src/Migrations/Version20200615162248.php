<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615162248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE abonnement_option (abonnement_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_B8B5BD2FF1D74413 (abonnement_id), INDEX IDX_B8B5BD2FA7C41D6F (option_id), PRIMARY KEY(abonnement_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement_option ADD CONSTRAINT FK_B8B5BD2FF1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abonnement_option ADD CONSTRAINT FK_B8B5BD2FA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE option_abonnement');
        $this->addSql('ALTER TABLE dispose CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL, CHANGE fruit_id fruit_id INT DEFAULT NULL, CHANGE legume_id legume_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_abonnement CHANGE user_id user_id INT DEFAULT NULL, CHANGE abonnement_id abonnement_id INT DEFAULT NULL, CHANGE options options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE abonnement CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE options_tab options_tab LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE option_abonnement (option_id INT NOT NULL, abonnement_id INT NOT NULL, INDEX IDX_D87B708BF1D74413 (abonnement_id), INDEX IDX_D87B708BA7C41D6F (option_id), PRIMARY KEY(option_id, abonnement_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE option_abonnement ADD CONSTRAINT FK_D87B708BA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_abonnement ADD CONSTRAINT FK_D87B708BF1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE abonnement_option');
        $this->addSql('ALTER TABLE abonnement CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE options_tab options_tab LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE dispose CHANGE viande_id viande_id INT DEFAULT NULL, CHANGE fruit_id fruit_id INT DEFAULT NULL, CHANGE legume_id legume_id INT DEFAULT NULL, CHANGE farmer_id farmer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_abonnement CHANGE user_id user_id INT DEFAULT NULL, CHANGE abonnement_id abonnement_id INT DEFAULT NULL, CHANGE options options LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
