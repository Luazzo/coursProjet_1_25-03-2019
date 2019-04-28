<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422183437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, slug_id INT DEFAULT NULL, description_id INT DEFAULT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_64C19C171179CD6 (name_id), UNIQUE INDEX UNIQ_64C19C1311966CE (slug_id), UNIQUE INDEX UNIQ_64C19C1D9F966B (description_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C171179CD6 FOREIGN KEY (name_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1311966CE FOREIGN KEY (slug_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1D9F966B FOREIGN KEY (description_id) REFERENCES texte (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category');
    }
}
