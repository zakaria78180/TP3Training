<?php
// src/Controller/AccueilController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'testcontroller')]
    public function index()
    {
        return $this->render('test/index.html.twig');
    }
}
