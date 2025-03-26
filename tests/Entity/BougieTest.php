<?php

namespace App\tests\Entity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BougieTest extends KernelTestCase
{
    
    
    public function getEntity():BougieCode
    {
    return (new BougieCode())
        ->setCode('12345')
        ->setDescription('Description de test')
        ->setExpireAt(new \DateTime());

    }
    
    public function assertWasErrors(BougieCode $code, int $number =  0){
        self::bootKernel();
        $error = self::$container->get('validator')->validate($code);
        $this->asserCount($number,$error);

    }
    
    
    
    public function testValidEntity()
    {
    
        $this->assertWasErrors($this->getEntity(), 0);
    }

     public function testInvalidCodeEntity()
     {
         $this->assertWasErrors($this->getEntity()->setCode('1a345'), 1);
        $this->assertWasErrors($this->getEntity()->setCode('1345'), 1);

     }
     public function testInvalidBlankCodeEntity()
     {
         $this->assertWasErrors($this->getEntity()->setCode(''), 1);
     }

     public function testInvalidBlankDescriptionEntity()
     {
         $this->assertWasErrors($this->getEntity()->setDescription(''), 1);
     }

    public function testInvalidUsedCode()
     {
         $this->loadFixtures([dirname(__DIR__) .
         '/fixtures/BougieTestFixtures.yaml']);
        $this->assertWasErrors($this->getEntity()->setCode('54321'),1);
     }

    

}
