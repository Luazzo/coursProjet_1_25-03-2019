<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422222128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, slug_id INT DEFAULT NULL, title_id INT DEFAULT NULL, description_id INT DEFAULT NULL, suite_text_id INT DEFAULT NULL, date DATETIME NOT NULL, comments INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C015514371179CD6 (name_id), UNIQUE INDEX UNIQ_C0155143311966CE (slug_id), UNIQUE INDEX UNIQ_C0155143A9F87BD (title_id), UNIQUE INDEX UNIQ_C0155143D9F966B (description_id), UNIQUE INDEX UNIQ_C0155143E8BE2C4 (suite_text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_category (blog_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_72113DE6DAE07E97 (blog_id), INDEX IDX_72113DE612469DE2 (category_id), PRIMARY KEY(blog_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C015514371179CD6 FOREIGN KEY (name_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143311966CE FOREIGN KEY (slug_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143A9F87BD FOREIGN KEY (title_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143D9F966B FOREIGN KEY (description_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143E8BE2C4 FOREIGN KEY (suite_text_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6DAE07E97');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE blog_category');
    }
}
