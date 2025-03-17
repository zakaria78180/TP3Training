<?php

namespace App\Controller\Admin;

use App\Entity\Fondant;
use App\Form\FondantType;
use App\Model\FiltreFondant;
use App\Form\FiltreFondantType;
use App\Repository\FondantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FondantController extends AbstractController
{
    #[Route('/admin/Fondant', name: 'admin_Fondant',methods:["GET","POST"])]
    public function listeFondant(FondantRepository $repo, Request $request): Response
    {
        $filtre = new FiltreFondant();
        $formFiltreFondant = $this->createForm(FiltreFondantType::class, $filtre);
        $formFiltreFondant->handleRequest($request);
        $Fondants = $repo->ListeFondants($filtre);
    
           

        return $this->render('admin/Fondant/listeFondants.html.twig', [
            'lesFondants' => $Fondants,
            'FiltreFondant' => $formFiltreFondant->createView()
        ]);
    }

    #[Route('/admin/Fondant/ajout', name: 'admin_Fondant_ajout', methods:["GET","POST"])]
    #[Route('/admin/Fondant/modif/{id}', name: 'admin_Fondant_modif', methods:["GET","POST"])]
    public function ajoutFondant(Fondant $Fondant = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        if ($Fondant == null) {
            $Fondant = new Fondant();
            $mode = "ajouté";
        } else {
            $mode = "modifié";
        }
        $form = $this->createForm(FondantType::class, $Fondant);
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
                    // handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the image file name
                // instead of its contents
                $Fondant->setImageFilename($newFilename);
            }

            $manager->persist($Fondant);
            $manager->flush();
             $this->addFlash("success","La Fondant a été $mode");
            return$this->redirectToRoute('admin_Fondant');
        }
        return $this->render('admin/Fondant/formAjoutModifFondant.html.twig', [
            'formFondant' => $form->createView()
        ]);
    }

    #[Route('/admin/Fondant/suppr/{id}', name: 'admin_Fondant_suppr', methods: ["GET"])]
    public function supprFondant(Fondant $Fondant, EntityManagerInterface $manager)
    {
            $manager->remove($Fondant);
            $manager->flush(); 
            $this->addFlash("success","La Fondant a été supprimée");
            return$this->redirectToRoute('admin_Fondant');

    }

}
