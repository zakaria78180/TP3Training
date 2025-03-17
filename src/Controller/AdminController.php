<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ObjetDecorationType;
use App\Entity\ObjetDecoration;

class AdminController extends AbstractController
{
    public function ajoutObjet(Request $request): Response
    {
        $objetDecoration = new ObjetDecoration();
        $form = $this->createForm(ObjetDecorationType::class, $objetDecoration);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement du formulaire
        }

        return $this->render('admin/ajoutObjet.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}