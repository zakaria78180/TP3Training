<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testHelloPage(){
        $client = static::createClient();
        $client->request(method:'GET', url:'/hello');
        $this->assertResponseStatusCodeSame(expectedCode: Response::HTTP_OK);
    }

}