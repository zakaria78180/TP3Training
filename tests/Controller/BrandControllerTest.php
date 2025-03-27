<?php

namespace App\Tests\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BrandControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/brand/');
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des marques');
    }
    
    public function testNew(): void
    {
        $client = static::createClient();
        $client->request('GET', '/brand/new');
        
        $this->assertResponseIsSuccessful();
        
        $client->submitForm('Enregistrer', [
            'brand[name]' => 'Nouvelle Marque Test',
        ]);
        
        $this->assertResponseRedirects('/brand/');
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert-success', 'La marque a été créée avec succès');
    }
    
    public function testShow(): void
    {
        $client = static::createClient();
        
        // Créer une marque pour le test
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $brand = new Brand();
        $brand->setName('Marque Test Show');
        $entityManager->persist($brand);
        $entityManager->flush();
        
        $client->request('GET', '/brand/' . $brand->getId());
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Détails de la marque');
    }
    
    public function testEdit(): void
    {
        $client = static::createClient();
        
        // Créer une marque pour le test
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $brand = new Brand();
        $brand->setName('Marque Test Edit');
        $entityManager->persist($brand);
        $entityManager->flush();
        
        $client->request('GET', '/brand/' . $brand->getId() . '/edit');
        
        $this->assertResponseIsSuccessful();
        
        $client->submitForm('Mettre à jour', [
            'brand[name]' => 'Marque Test Modifiée',
        ]);
        
        $this->assertResponseRedirects('/brand/');
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert-success', 'La marque a été modifiée avec succès');
    }
    
    public function testStatistics(): void
    {
        $client = static::createClient();
        $client->request('GET', '/brand/statistics');
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Statistiques des marques');
    }
}
