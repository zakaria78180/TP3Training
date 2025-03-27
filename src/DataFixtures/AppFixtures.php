<?php

namespace App\DataFixtures;

use App\Entity\Bougie;
use App\Entity\Poudre;
use App\Entity\ObjetDecoration;
use App\Entity\Brand; // Ajout de l'import manquant
use App\Entity\Article; // Ajout de l'import manquant
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Chargement des données existantes
        $this->loadBougies($manager);
        $this->loadPoudre($manager);
        $this->loadObjetsDecoration($manager);
        
        // Chargement des marques et articles
        $this->loadBrandsAndArticles($manager);
    }
    
    public function getGroups(): array
    {
        return ['main'];
    }
    
    private function loadBougies(ObjectManager $manager): void
    {
        $lesBougies = $this->chargefichier("Bougie.csv");

        foreach ($lesBougies as $value)
        {
            $bougie = new Bougie();
            $bougie    
                ->setNom($value[1])
                ->setMateriaux($value[2])
                ->setPrix($value[3])
                ->setCouleur($value[4])
                ->setDescription($value[4]) // Même valeur que couleur, est-ce intentionnel?
                ->setPoids($value[5]) // Correction de setPoid à setPoids si c'est le nom correct de la méthode
                ->setDureeDeVie($value[6]) // Correction de setDdv à setDureeDeVie si c'est le nom correct
                ->setTaille($value[7])
                ->setImage('https://lorempicture.point-sys.com/400/300/'.mt_rand(1,30));
            
            $manager->persist($bougie);
        }
        $manager->flush();
    }

    private function loadObjetsDecoration(ObjectManager $manager): void
    {
        $lesObjetsDeco = $this->chargefichier("ObjetsDecoration.csv");

        foreach ($lesObjetsDeco as $value) {
            $objetDeco = new ObjetDecoration();
            $objetDeco
                ->setNom($value[1])
                ->setMateriaux($value[2])
                ->setCouleur($value[2]) // Même valeur que matériaux, est-ce intentionnel?
                ->setDescription($value[2]) // Même valeur que matériaux, est-ce intentionnel?
                ->setPrix($value[3])
                ->setImage('https://lorempicture.point-sys.com/400/300/'.mt_rand(1,30));
            
            $manager->persist($objetDeco);
        }
        $manager->flush();
    }

    private function loadPoudre(ObjectManager $manager): void
    {
        $lesPoudres = $this->chargefichier("Poudre.csv");

        foreach ($lesPoudres as $value)
        {
            $poudre = new Poudre();
            $poudre    
                ->setNom($value[1])
                ->setMateriaux($value[2])
                ->setPrix(3.3) // Valeur fixe au lieu de prendre depuis le CSV
                ->setCouleur($value[4])     
                ->setPoids(5) // Valeur fixe au lieu de prendre depuis le CSV
                ->setDureeDeVie($value[6])
                ->setTaille(floatval($value[7])) // Correction de l'indice 7.7 à 7 et conversion en float
                ->setDescription($value[8])
                ->setImage('https://lorempicture.point-sys.com/400/300/'.mt_rand(1,30));
            
            $manager->persist($poudre);
        }
        $manager->flush();
    }

    // Nouvelle méthode pour charger les marques et articles
    private function loadBrandsAndArticles(ObjectManager $manager): void
    {
        $brands = [];
        $brandNames = ['Apple', 'Samsung', 'Sony', 'LG', 'Xiaomi', 'Nike', 'Adidas', 'Puma'];
        
        foreach ($brandNames as $name) {
            $brand = new Brand();
            $brand->setName($name);
            $manager->persist($brand);
            $brands[] = $brand;
        }
        
        $articles = [
            ['Smartphone X', 'Un smartphone haut de gamme', 999.99, 0],
            ['Télévision 4K', 'Une télévision avec une résolution 4K', 1499.99, 2],
            ['Écouteurs sans fil', 'Des écouteurs avec réduction de bruit', 199.99, 0],
            ['Ordinateur portable', 'Un ordinateur portable puissant', 1299.99, 0],
            ['Montre connectée', 'Une montre intelligente', 299.99, 1],
            ['Tablette', 'Une tablette avec un grand écran', 599.99, 0],
            ['Enceinte Bluetooth', 'Une enceinte portable', 149.99, 2],
            ['Chaussures de course', 'Des chaussures légères pour la course', 89.99, 5],
            ['Maillot de football', 'Maillot officiel', 79.99, 6],
            ['Ballon de basket', 'Ballon de basket professionnel', 29.99, 7],
            ['Casque audio', 'Casque audio avec une excellente qualité sonore', 249.99, 2],
            ['Appareil photo', 'Appareil photo reflex', 899.99, 2],
            ['Réfrigérateur', 'Réfrigérateur économe en énergie', 799.99, 3],
            ['Machine à laver', 'Machine à laver avec plusieurs programmes', 699.99, 3],
            ['Aspirateur', 'Aspirateur sans fil', 299.99, 4],
        ];
        
        foreach ($articles as [$name, $description, $price, $brandIndex]) {
            $article = new Article();
            $article->setName($name);
            $article->setDescription($description);
            $article->setPrice($price);
            $article->setBrand($brands[$brandIndex]);
            $manager->persist($article);
        }
        
        $manager->flush();
    }

    public function chargefichier($fichier)
    {
        $fichierCsv = fopen(__DIR__ . "/" . $fichier, "r");
        $data = [];
        
        while (($row = fgetcsv($fichierCsv)) !== false) {
            $data[] = $row;
        }
        
        fclose($fichierCsv);
        return $data;
    }
}