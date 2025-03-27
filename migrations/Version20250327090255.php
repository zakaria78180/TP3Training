<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327090255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bougie DROP nom, DROP prix, DROP image, DROP description, DROP materiaux, DROP image_file_name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE bougie ADD CONSTRAINT FK_7702275CBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brand ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE diffuseur_voiture ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diffuseur_voiture ADD CONSTRAINT FK_DAD2EBD644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_DAD2EBD644F5D008 ON diffuseur_voiture (brand_id)');
        $this->addSql('ALTER TABLE fondant DROP nom, DROP prix, DROP image, DROP description, DROP materiaux, DROP image_file_name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE fondant ADD CONSTRAINT FK_FBEDE04DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_decoration DROP nom, DROP prix, DROP image, DROP description, DROP materiaux, DROP image_file_name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE objet_decoration ADD CONSTRAINT FK_D47A0FDDBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poudre DROP nom, DROP prix, DROP image, DROP description, DROP materiaux, DROP image_file_name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE poudre ADD CONSTRAINT FK_926CF10FBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bougie DROP FOREIGN KEY FK_7702275CBF396750');
        $this->addSql('ALTER TABLE bougie ADD nom VARCHAR(255) NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD materiaux VARCHAR(255) NOT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE brand DROP image');
        $this->addSql('ALTER TABLE diffuseur_voiture DROP FOREIGN KEY FK_DAD2EBD644F5D008');
        $this->addSql('DROP INDEX IDX_DAD2EBD644F5D008 ON diffuseur_voiture');
        $this->addSql('ALTER TABLE diffuseur_voiture DROP brand_id');
        $this->addSql('ALTER TABLE fondant DROP FOREIGN KEY FK_FBEDE04DBF396750');
        $this->addSql('ALTER TABLE fondant ADD nom VARCHAR(255) NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD materiaux VARCHAR(255) NOT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE objet_decoration DROP FOREIGN KEY FK_D47A0FDDBF396750');
        $this->addSql('ALTER TABLE objet_decoration ADD nom VARCHAR(255) NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD materiaux VARCHAR(255) NOT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE poudre DROP FOREIGN KEY FK_926CF10FBF396750');
        $this->addSql('ALTER TABLE poudre ADD nom VARCHAR(255) NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD materiaux VARCHAR(255) NOT NULL, ADD image_file_name VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
