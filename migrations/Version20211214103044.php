<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214103044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE movie CHANGE uuid id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE movie ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE session DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE session ADD movie_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE uuid id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D48F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D48F93B6FC ON session (movie_id)');
        $this->addSql('ALTER TABLE session ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE movie CHANGE id uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE movie ADD PRIMARY KEY (uuid)');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D48F93B6FC');
        $this->addSql('DROP INDEX IDX_D044D5D48F93B6FC ON session');
        $this->addSql('ALTER TABLE session DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE session DROP movie_id, CHANGE id uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE session ADD PRIMARY KEY (uuid)');
    }
}
