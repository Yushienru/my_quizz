<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624082817 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, password VARCHAR(255) NOT NULL, email_verified_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE categorie_id categorie_id INT NOT NULL, CHANGE question question VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EBCF5E72D ON question (categorie_id)');
        $this->addSql('ALTER TABLE reponse CHANGE question_id question_id INT NOT NULL, CHANGE reponse reponse VARCHAR(255) NOT NULL, CHANGE reponse_expected reponse_expected SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC71E27F6BF ON reponse (question_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE categorie CHANGE name name VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBCF5E72D');
        $this->addSql('DROP INDEX IDX_B6F7494EBCF5E72D ON question');
        $this->addSql('ALTER TABLE question CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE question question VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('DROP INDEX IDX_5FB6DEC71E27F6BF ON reponse');
        $this->addSql('ALTER TABLE reponse CHANGE question_id question_id INT DEFAULT NULL, CHANGE reponse reponse VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE reponse_expected reponse_expected TINYINT(1) DEFAULT NULL');
    }
}
