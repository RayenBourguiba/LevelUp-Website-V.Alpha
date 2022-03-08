<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218104615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, post_date DATETIME NOT NULL, likes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classement (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, rang INT NOT NULL, UNIQUE INDEX UNIQ_55EE9D6D6D861B89 (equipe_id), INDEX IDX_55EE9D6DFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, blog_id INT DEFAULT NULL, user_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_67F068BCDAE07E97 (blog_id), INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_jeux (equipe_id INT NOT NULL, jeux_id INT NOT NULL, INDEX IDX_3E1C24F36D861B89 (equipe_id), INDEX IDX_3E1C24F3EC2AA9D2 (jeux_id), PRIMARY KEY(equipe_id, jeux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, organisateur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_equipe (evenement_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_97BC6A97FD02F13 (evenement_id), INDEX IDX_97BC6A976D861B89 (equipe_id), PRIMARY KEY(evenement_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeux (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, seen TINYINT(1) NOT NULL, date DATETIME NOT NULL, id_sender INT NOT NULL, id_reciever INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC2782EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date DATETIME NOT NULL, status INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, equipe_id INT DEFAULT NULL, reclamation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone INT NOT NULL, date_join DATETIME NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D649CCF9E01E (departement_id), INDEX IDX_8D93D6496D861B89 (equipe_id), INDEX IDX_8D93D6492D6BA2D9 (reclamation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6D6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6DFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE equipe_jeux ADD CONSTRAINT FK_3E1C24F36D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_jeux ADD CONSTRAINT FK_3E1C24F3EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_equipe ADD CONSTRAINT FK_97BC6A97FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_equipe ADD CONSTRAINT FK_97BC6A976D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCDAE07E97');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2782EA2E54');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCF9E01E');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6D6D861B89');
        $this->addSql('ALTER TABLE equipe_jeux DROP FOREIGN KEY FK_3E1C24F36D861B89');
        $this->addSql('ALTER TABLE evenement_equipe DROP FOREIGN KEY FK_97BC6A976D861B89');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496D861B89');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6DFD02F13');
        $this->addSql('ALTER TABLE evenement_equipe DROP FOREIGN KEY FK_97BC6A97FD02F13');
        $this->addSql('ALTER TABLE equipe_jeux DROP FOREIGN KEY FK_3E1C24F3EC2AA9D2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492D6BA2D9');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE classement');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_jeux');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_equipe');
        $this->addSql('DROP TABLE jeux');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE user');
    }
}
