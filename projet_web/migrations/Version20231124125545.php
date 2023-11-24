<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124125545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD id_auteur_id INT DEFAULT NULL, ADD photo_profil LONGBLOB NOT NULL, ADD mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3E08ED3C1 FOREIGN KEY (id_auteur_id) REFERENCES auteur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E08ED3C1 ON utilisateur (id_auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3E08ED3C1');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3E08ED3C1 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP id_auteur_id, DROP photo_profil, DROP mail');
    }
}
