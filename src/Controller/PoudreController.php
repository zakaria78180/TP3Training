<?php

namespace App\Controller;

use App\Entity\Poudre;
use App\Form\FiltrePoudreType;
use App\Repository\PoudreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PoudreController extends AbstractController
{
    #[Route('/poudre', name: 'poudre')]
    public function listePoudre(Request $request, PoudreRepository $poudreRepository): Response
    {
        $formFiltrePoudre = $this->createForm(FiltrePoudreType::class);
        $formFiltrePoudre->handleRequest($request);

        $poudres = [];

        if ($formFiltrePoudre->isSubmitted() && $formFiltrePoudre->isValid()) {
            $searchTerm = $formFiltrePoudre->get('nom')->getData();

            if (strlen($searchTerm) >= 2) {
                $poudres = $poudreRepository->findByNom($searchTerm);
            } else {
                $this->addFlash('info', 'Please enter at least 2 characters for the search.');
                $poudres = $poudreRepository->findAll();
            }
        } else {
            $poudres = $poudreRepository->findAll();
        }

        return $this->render('poudre/listePoudres.html.twig', [
            'FiltrePoudre' => $formFiltrePoudre->createView(),
            'LesPoudres' => $poudres,
        ]);
    }
    
    #[Route('/poudre/{id}', name: 'FichePoudre', methods: 'GET')]
    public function FichePoudre(Poudre $poudre)
    {
        return $this->render('poudre/FichePoudre.html.twig', [
            'LaPoudre' => $poudre
        ]);
    }
}
