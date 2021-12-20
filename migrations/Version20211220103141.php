<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220103141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', movie_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', total_tickets INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_D044D5D48F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', session_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', client_name VARCHAR(255) NOT NULL, client_phone_number VARCHAR(255) NOT NULL, INDEX IDX_97A0ADA3613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D48F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D48F93B6FC');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3613FECDF');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE ticket');
    }
}
