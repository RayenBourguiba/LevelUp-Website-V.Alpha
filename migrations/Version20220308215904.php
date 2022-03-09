<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308215904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bloglikes');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6DFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE commande DROP date, DROP quantite, DROP prix_total, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE departement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE equipe_jeux ADD CONSTRAINT FK_3E1C24F36D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_jeux ADD CONSTRAINT FK_3E1C24F3EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_equipe ADD CONSTRAINT FK_97BC6A97FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_equipe ADD CONSTRAINT FK_97BC6A976D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeux CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX IDX_B6BD307FCD53EDB6 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307FF624B39D ON message');
        $this->addSql('ALTER TABLE message ADD id_sender INT NOT NULL, ADD id_reciever INT NOT NULL, DROP sender_id, DROP receiver_id, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE seen seen TINYINT(1) NOT NULL, CHANGE contenu content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD commande_id INT DEFAULT NULL, DROP solde, DROP active, DROP referance, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2782EA2E54 ON produit (commande_id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('DROP INDEX user_id ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP user_id, DROP email, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD reclamation_id INT DEFAULT NULL, DROP username, DROP roles, DROP banned, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CCF9E01E ON user (departement_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496D861B89 ON user (equipe_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492D6BA2D9 ON user (reclamation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bloglikes (id INT NOT NULL, blog_id INT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_F43FB2F6A76ED395 (user_id), INDEX IDX_F43FB2F6DAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ligne_commande (id INT NOT NULL, produit_id INT DEFAULT NULL, quantite INT NOT NULL, commande_id INT DEFAULT NULL, INDEX IDX_3170B74B82EA2E54 (commande_id), INDEX IDX_3170B74BF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hashed_token VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6DFD02F13');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande ADD date DATE NOT NULL, ADD quantite INT NOT NULL, ADD prix_total DOUBLE PRECISION NOT NULL, CHANGE id id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCDAE07E97');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE departement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE equipe_jeux DROP FOREIGN KEY FK_3E1C24F36D861B89');
        $this->addSql('ALTER TABLE equipe_jeux DROP FOREIGN KEY FK_3E1C24F3EC2AA9D2');
        $this->addSql('ALTER TABLE evenement_equipe DROP FOREIGN KEY FK_97BC6A97FD02F13');
        $this->addSql('ALTER TABLE evenement_equipe DROP FOREIGN KEY FK_97BC6A976D861B89');
        $this->addSql('ALTER TABLE jeux CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD sender_id INT NOT NULL, ADD receiver_id INT NOT NULL, DROP id_sender, DROP id_reciever, CHANGE id id INT NOT NULL, CHANGE seen seen TINYINT(1) DEFAULT NULL, CHANGE content contenu LONGTEXT NOT NULL');
        $this->addSql('CREATE INDEX IDX_B6BD307FCD53EDB6 ON message (receiver_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FF624B39D ON message (sender_id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2782EA2E54');
        $this->addSql('DROP INDEX IDX_29A5EC2782EA2E54 ON produit');
        $this->addSql('ALTER TABLE produit ADD solde DOUBLE PRECISION DEFAULT NULL, ADD active TINYINT(1) NOT NULL, ADD referance VARCHAR(255) NOT NULL, DROP commande_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD user_id INT NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX user_id ON reclamation (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCF9E01E');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496D861B89');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492D6BA2D9');
        $this->addSql('DROP INDEX IDX_8D93D649CCF9E01E ON user');
        $this->addSql('DROP INDEX IDX_8D93D6496D861B89 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6492D6BA2D9 ON user');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD banned TINYINT(1) NOT NULL, DROP reclamation_id, CHANGE password password VARCHAR(255) DEFAULT NULL');
    }
}
