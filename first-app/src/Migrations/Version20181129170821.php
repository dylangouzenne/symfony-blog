<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129170821 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire ADD fk_article_id INT DEFAULT NULL, DROP appartient, CHANGE cresated_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC82FA4C0F FOREIGN KEY (fk_article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC82FA4C0F ON commentaire (fk_article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC82FA4C0F');
        $this->addSql('DROP INDEX IDX_67F068BC82FA4C0F ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD appartient VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP fk_article_id, CHANGE created_at cresated_at DATETIME NOT NULL');
    }
}
