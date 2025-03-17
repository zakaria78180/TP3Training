<?php
// src/Controller/AccueilController.php
namespace App\Controller;

use App\Repository\BougieRepository;
use App\Repository\PoudreRepository;
use App\Repository\ObjetDecorationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(BougieRepository $bougieRepository, ObjetDecorationRepository $ObjectDecoRepository, PoudreRepository $poudreRepository)
    {
        $bougies = $bougieRepository->findAll();
        $objetsDeco = $ObjectDecoRepository->findAll();
        $poudres = $poudreRepository->findAll();

        $listeAll = array_merge($bougies, $objetsDeco, $poudres);

        return $this->render('accueil/index.html.twig', [
            'listeAll' => $listeAll
        ]);
    }
}