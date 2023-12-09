<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231209135254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur CHANGE photo_auteur photo_auteur VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX `primary` ON livre_auteur');
        $this->addSql('ALTER TABLE livre_auteur DROP FOREIGN KEY FK_A6DFA5E037D925CB');
        $this->addSql('ALTER TABLE livre_auteur DROP FOREIGN KEY FK_A6DFA5E060BB6FE6');
        $this->addSql('ALTER TABLE livre_auteur ADD PRIMARY KEY (livre_id, auteur_id)');
        $this->addSql('DROP INDEX idx_a6dfa5e037d925cb ON livre_auteur');
        $this->addSql('CREATE INDEX IDX_A11876B537D925CB ON livre_auteur (livre_id)');
        $this->addSql('DROP INDEX idx_a6dfa5e060bb6fe6 ON livre_auteur');
        $this->addSql('CREATE INDEX IDX_A11876B560BB6FE6 ON livre_auteur (auteur_id)');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A6DFA5E037D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A6DFA5E060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD maj_photo_profil DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur CHANGE photo_auteur photo_auteur LONGBLOB NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON livre_auteur');
        $this->addSql('ALTER TABLE livre_auteur DROP FOREIGN KEY FK_A11876B537D925CB');
        $this->addSql('ALTER TABLE livre_auteur DROP FOREIGN KEY FK_A11876B560BB6FE6');
        $this->addSql('ALTER TABLE livre_auteur ADD PRIMARY KEY (auteur_id, livre_id)');
        $this->addSql('DROP INDEX idx_a11876b537d925cb ON livre_auteur');
        $this->addSql('CREATE INDEX IDX_A6DFA5E037D925CB ON livre_auteur (livre_id)');
        $this->addSql('DROP INDEX idx_a11876b560bb6fe6 ON livre_auteur');
        $this->addSql('CREATE INDEX IDX_A6DFA5E060BB6FE6 ON livre_auteur (auteur_id)');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B560BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur DROP maj_photo_profil');
    }
}
