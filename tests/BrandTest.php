<?php

namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    public function testGetterAndSetter(): void
    {
        $brand = new Brand();
        
        // Test name
        $brand->setName('Test Brand');
        $this->assertEquals('Test Brand', $brand->getName());
        
        // Test toString
        $this->assertEquals('Test Brand', $brand->__toString());
        
        // Test articles collection
        $this->assertCount(0, $brand->getArticles());
        
        // Test adding article
        $article = new Article();
        $article->setName('Test Article');
        $article->setPrice(10.99);
        
        $brand->addArticle($article);
        $this->assertCount(1, $brand->getArticles());
        $this->assertSame($brand, $article->getBrand());
        
        // Test removing article
        $brand->removeArticle($article);
        $this->assertCount(0, $brand->getArticles());
        $this->assertNull($article->getBrand());
    }
}

