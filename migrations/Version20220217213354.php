<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217213354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classement ADD equipe_id INT DEFAULT NULL, ADD evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6D6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6DFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55EE9D6D6D861B89 ON classement (equipe_id)');
        $this->addSql('CREATE INDEX IDX_55EE9D6DFD02F13 ON classement (evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6D6D861B89');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6DFD02F13');
        $this->addSql('DROP INDEX UNIQ_55EE9D6D6D861B89 ON classement');
        $this->addSql('DROP INDEX IDX_55EE9D6DFD02F13 ON classement');
        $this->addSql('ALTER TABLE classement DROP equipe_id, DROP evenement_id');
    }
}
