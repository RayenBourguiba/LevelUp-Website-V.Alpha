<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307163919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review ADD jeux_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64C32EAF4 FOREIGN KEY (jeux_id_id) REFERENCES jeux (id)');
        $this->addSql('CREATE INDEX IDX_794381C64C32EAF4 ON review (jeux_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C64C32EAF4');
        $this->addSql('DROP INDEX IDX_794381C64C32EAF4 ON review');
        $this->addSql('ALTER TABLE review DROP jeux_id_id');
    }
}
