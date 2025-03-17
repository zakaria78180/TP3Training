<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317144524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, paid TINYINT(1) NOT NULL, validated TINYINT(1) NOT NULL, INDEX IDX_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_item (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, bougie_id INT DEFAULT NULL, object_decoration_id INT DEFAULT NULL, poudre_id INT DEFAULT NULL, fondant_id INT DEFAULT NULL, quantity INT UNSIGNED DEFAULT 1 NOT NULL, INDEX IDX_F0FE25271AD5CDBF (cart_id), INDEX IDX_F0FE2527372CC1DA (bougie_id), INDEX IDX_F0FE2527E77751B6 (object_decoration_id), INDEX IDX_F0FE252724BE7F10 (poudre_id), INDEX IDX_F0FE25279EC6B671 (fondant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fondant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, materiaux VARCHAR(255) NOT NULL, image_file_name VARCHAR(255) DEFAULT NULL, ddv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25271AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE2527372CC1DA FOREIGN KEY (bougie_id) REFERENCES bougie (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE2527E77751B6 FOREIGN KEY (object_decoration_id) REFERENCES objet_decoration (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE252724BE7F10 FOREIGN KEY (poudre_id) REFERENCES poudre (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25279EC6B671 FOREIGN KEY (fondant_id) REFERENCES fondant (id)');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE bougie ADD description VARCHAR(255) DEFAULT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE nom_b nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE diffuseur_voiture ADD image_filename VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(500) NOT NULL, CHANGE durée_de_vie duree_de_vie INT NOT NULL');
        $this->addSql('ALTER TABLE objet_decoration ADD materiaux VARCHAR(255) NOT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL, ADD couleur VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE poudre ADD image_file_name VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE durée_de_vie duree_de_vie INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD sexe INT NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hashed_token VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25271AD5CDBF');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE2527372CC1DA');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE2527E77751B6');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE252724BE7F10');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25279EC6B671');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE fondant');
        $this->addSql('ALTER TABLE bougie DROP description, DROP image_file_name, CHANGE prix prix NUMERIC(10, 0) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE nom nom_b VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE diffuseur_voiture DROP image_filename, CHANGE description description VARCHAR(255) NOT NULL, CHANGE duree_de_vie durée_de_vie INT NOT NULL');
        $this->addSql('ALTER TABLE objet_decoration DROP materiaux, DROP image_file_name, DROP couleur, CHANGE image image VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE poudre DROP image_file_name, CHANGE image image VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE duree_de_vie durée_de_vie INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP sexe, DROP avatar');
    }
}
