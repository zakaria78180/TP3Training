<?php

namespace App\Controller;

use App\Entity\DiffuseurVoiture;
use App\Repository\DiffuseurVoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiffuseurVoitureController extends AbstractController
{
    #[Route('/diffuseur-voiture', name: 'diffuseur_voiture_list', methods: 'GET')]
    public function list(DiffuseurVoitureRepository $repo): Response
    {
        $diffuseurs = $repo->findAll();
        return $this->render('diffuseurvoiture/listeDiffuseurvoiture.html.twig', [
            'diffuseurs' => $diffuseurs
        ]);
    }

    #[Route('/diffuseur-voiture/{id}', name: 'diffuseur_voiture_Fiche', methods: 'GET')]
    public function detail(DiffuseurVoiture $diffuseur): Response
    {
        return $this->render('diffuseurvoiture/ficheDiffuseurvoiture.html.twig', [
            'diffuseur' => $diffuseur
        ]);
    }
}