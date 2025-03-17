<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121104516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE poudre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, materiaux VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, couleur VARCHAR(255) NOT NULL, poids DOUBLE PRECISION NOT NULL, durée_de_vie DATETIME NOT NULL, taille DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet_decoration DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE poudre');
        $this->addSql('ALTER TABLE objet_decoration ADD image VARCHAR(255) NOT NULL');
    }
}
