<?php

namespace App\Controller\Admin;

use App\Entity\ObjetDecoration;
use App\Form\ObjetDecorationType;
use App\Repository\ObjetDecorationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ObjetDecorationController extends AbstractController
{
    #[Route('/admin/objectdecoration', name: 'admin_objectdecoration', methods:"GET")]
    public function listeObjectDecorations(ObjetDecorationRepository $repo): Response
    {
        $objectDecorations = $repo->findAll();
        return $this->render('admin/objectdecoration/listeObjectDecoration.html.twig', [
            'lesObjectDecorations' => $objectDecorations
        ]);
    }
    
    #[Route('/admin/objectdecoration/ajout', name: 'admin_objectdecoration_ajout', methods:["GET","POST"])]
    #[Route('/admin/objectdecoration/ajout/modif{id}', name: 'admin_objectdecoration_modif', methods:["GET","POST"])]
    public function ajoutObjectDecoration(ObjetDecoration $objectDecoration = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        if ($objectDecoration == null) {
            $objectDecoration = new ObjetDecoration();
            $mode = "ajouté";
        } else {
            $mode = "modifié";
        }
        $form = $this->createForm(ObjetDecorationType::class, $objectDecoration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                
                $objectDecoration->setImageFilename($newFilename);
            }

            $manager->persist($objectDecoration);
            $manager->flush();
            $this->addFlash("success", "L'objet de décoration a bien été $mode");
            return $this->redirectToRoute('admin_objectdecoration');
        }
        return $this->render('admin/objectdecoration/formAjoutModifObjectDecoration.html.twig', [
            'formObjectDecoration' => $form->createView()
        ]);
    }

    #[Route('/admin/objectdecoration/ajout/suppression{id}', name: 'admin_objectdecoration_suppression', methods:"GET")]
    public function suppressionObjectDecoration(ObjetDecoration $objectDecoration = null, EntityManagerInterface $manager): Response
    {
        if ($objectDecoration) {
            $manager->remove($objectDecoration);
            $manager->flush();
            $this->addFlash("success", "L'objet de décoration a bien été supprimé");
        }
        return $this->redirectToRoute('admin_objectdecoration');
    }
}
