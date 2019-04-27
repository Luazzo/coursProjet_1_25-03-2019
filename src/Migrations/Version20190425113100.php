<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425113100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_140AB620989D9B62 ON page');
        $this->addSql('ALTER TABLE page ADD slug_id INT DEFAULT NULL, DROP slug, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE content content VARCHAR(255) DEFAULT NULL, CHANGE text_lead text_lead VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620311966CE FOREIGN KEY (slug_id) REFERENCES texte (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620311966CE ON page (slug_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620311966CE');
        $this->addSql('DROP INDEX UNIQ_140AB620311966CE ON page');
        $this->addSql('ALTER TABLE page ADD slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP slug_id, CHANGE name name VARCHAR(55) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE text_lead text_lead LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE content content LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620989D9B62 ON page (slug)');
    }
}
