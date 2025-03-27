<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\Brand;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testGetterAndSetter(): void
    {
        $article = new Article();
        
        // Test name
        $article->setName('Test Article');
        $this->assertEquals('Test Article', $article->getName());
        
        // Test description
        $article->setDescription('Test Description');
        $this->assertEquals('Test Description', $article->getDescription());
        
        // Test price
        $article->setPrice(99.99);
        $this->assertEquals(99.99, $article->getPrice());
        
        // Test brand
        $brand = new Brand();
        $brand->setName('Test Brand');
        
        $article->setBrand($brand);
        $this->assertSame($brand, $article->getBrand());
    }
}

