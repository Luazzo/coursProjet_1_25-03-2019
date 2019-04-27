<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190427205600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE work ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E688019EB6921 FOREIGN KEY (client_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_534E688019EB6921 ON work (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E688019EB6921');
        $this->addSql('DROP INDEX IDX_534E688019EB6921 ON work');
        $this->addSql('ALTER TABLE work DROP client_id');
    }
}
