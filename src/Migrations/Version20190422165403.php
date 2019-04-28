<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422165403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1DAE07E97');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CDAE07E97');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FDAE07E97');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F12469DE2');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB5A459A0');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBB3453DB');
        $this->addSql('ALTER TABLE work_tag DROP FOREIGN KEY FK_79E7E01FBB3453DB');
        $this->addSql('CREATE TABLE texte (id INT AUTO_INCREMENT NOT NULL, en LONGTEXT NOT NULL, fr LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE work');
        $this->addSql('DROP TABLE work_tag');
        $this->addSql('ALTER TABLE page ADD name VARCHAR(55) NOT NULL, ADD url VARCHAR(255) NOT NULL, ADD date DATETIME NOT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD big_title VARCHAR(255) DEFAULT NULL, ADD title VARCHAR(255) DEFAULT NULL, ADD subtitle VARCHAR(255) DEFAULT NULL, ADD content LONGTEXT NOT NULL, CHANGE nom slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620989D9B62 ON page (slug)');
        $this->addSql('ALTER TABLE tag ADD slug_id INT DEFAULT NULL, ADD name_id INT DEFAULT NULL, ADD description_id INT DEFAULT NULL, DROP title, DROP description, DROP slug');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783311966CE FOREIGN KEY (slug_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B78371179CD6 FOREIGN KEY (name_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783D9F966B FOREIGN KEY (description_id) REFERENCES texte (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783311966CE ON tag (slug_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B78371179CD6 ON tag (name_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783D9F966B ON tag (description_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783311966CE');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B78371179CD6');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783D9F966B');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_C0155143A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, blog_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_64C19C1DAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, blog_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, INDEX IDX_9474526CDAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, news_id INT DEFAULT NULL, tag_id INT DEFAULT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, blog_id INT DEFAULT NULL, work_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, web_path VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, file VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, ord INT NOT NULL, INDEX IDX_C53D045FBAD26311 (tag_id), INDEX IDX_C53D045FA76ED395 (user_id), INDEX IDX_C53D045FBB3453DB (work_id), INDEX IDX_C53D045FB5A459A0 (news_id), INDEX IDX_C53D045F12469DE2 (category_id), INDEX IDX_C53D045FDAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(55) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, type VARCHAR(55) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_534E6880A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE work_tag (work_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_79E7E01FBB3453DB (work_id), INDEX IDX_79E7E01FBAD26311 (tag_id), PRIMARY KEY(work_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBB3453DB FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE work_tag ADD CONSTRAINT FK_79E7E01FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_tag ADD CONSTRAINT FK_79E7E01FBB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE texte');
        $this->addSql('DROP INDEX UNIQ_140AB620989D9B62 ON page');
        $this->addSql('ALTER TABLE page ADD nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP name, DROP slug, DROP url, DROP date, DROP description, DROP big_title, DROP title, DROP subtitle, DROP content');
        $this->addSql('DROP INDEX UNIQ_389B783311966CE ON tag');
        $this->addSql('DROP INDEX UNIQ_389B78371179CD6 ON tag');
        $this->addSql('DROP INDEX UNIQ_389B783D9F966B ON tag');
        $this->addSql('ALTER TABLE tag ADD title VARCHAR(55) NOT NULL COLLATE utf8mb4_unicode_ci, ADD description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP slug_id, DROP name_id, DROP description_id');
    }
}
