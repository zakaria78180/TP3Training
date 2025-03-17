<?php
namespace App\Controller;

use App\Entity\ObjetDeco;
use App\Form\ObjetDecoType;
use App\Repository\ObjetDecorationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjetDecoController extends AbstractController
{

    #[Route('/objetdecoration/liste', name: 'app_liste_objetdecoration', methods: ['GET'])]
    public function liste(ObjetDecorationRepository $repo): Response
    {
        $lesObjetsDeco = $repo->findAll();
        return $this->render('objetdecoration/listeObjetdecoration.html.twig', [
            'LesObjetsDeco' => $lesObjetsDeco,
        ]);
    }

    #[Route('/objetdecoration/{id}', name: 'app_fiche_objetdecoration', methods: ['GET'])]
    public function fiche(int $id, ObjetDecorationRepository $repo): Response
    {
        $objetDeco = $repo->find($id);
        if (!$objetDeco) {
            throw $this->createNotFoundException('L\'objet décoratif n\'a pas été trouvé.');
        }
        return $this->render('objetdecoration/ficheObjetdecoration.html.twig', [
            'objetDeco' => $objetDeco,
        ]);
    }
    
}
