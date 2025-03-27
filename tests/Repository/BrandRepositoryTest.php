<?php

namespace App\Tests\Repository;

use App\Entity\Article;
use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BrandRepositoryTest extends KernelTestCase
{
    private $entityManager;
    private $brandRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        $this->brandRepository = $this->entityManager->getRepository(Brand::class);
    }

    public function testGetBrandsWithArticleCount(): void
    {
        // Créer des données de test
        $brand1 = new Brand();
        $brand1->setName('Brand Test 1');
        $this->entityManager->persist($brand1);
        
        $brand2 = new Brand();
        $brand2->setName('Brand Test 2');
        $this->entityManager->persist($brand2);
        
        // Ajouter des articles
        $article1 = new Article();
        $article1->setName('Article Test 1');
        $article1->setPrice(10.99);
        $article1->setBrand($brand1);
        $this->entityManager->persist($article1);
        
        $article2 = new Article();
        $article2->setName('Article Test 2');
        $article2->setPrice(20.99);
        $article2->setBrand($brand1);
        $this->entityManager->persist($article2);
        
        $article3 = new Article();
        $article3->setName('Article Test 3');
        $article3->setPrice(30.99);
        $article3->setBrand($brand2);
        $this->entityManager->persist($article3);
        
        $this->entityManager->flush();
        
        // Tester la méthode
        $result = $this->brandRepository->getBrandsWithArticleCount();
        
        // Vérifier les résultats
        $this->assertIsArray($result);
        $this->assertGreaterThanOrEqual(2, count($result));
        
        // Trouver nos marques de test dans les résultats
        $brand1Result = null;
        $brand2Result = null;
        
        foreach ($result as $item) {
            if ($item['name'] === 'Brand Test 1') {
                $brand1Result = $item;
            } elseif ($item['name'] === 'Brand Test 2') {
                $brand2Result = $item;
            }
        }
        
        $this->assertNotNull($brand1Result);
        $this->assertNotNull($brand2Result);
        $this->assertEquals(2, $brand1Result['articleCount']);
        $this->assertEquals(1, $brand2Result['articleCount']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

