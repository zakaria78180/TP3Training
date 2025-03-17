<?php

namespace App\Controller\Admin;

use App\Entity\Bougie;
use App\Form\BougieType;
use App\Model\FiltreBougie;
use App\Form\FiltreBougieType;
use App\Repository\BougieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BougieController extends AbstractController
{
    #[Route('/admin/bougie', name: 'admin_Bougie',methods:["GET","POST"])]
    public function listeBougie(BougieRepository $repo, Request $request): Response
    {
        $filtre = new FiltreBougie();
        $formFiltreBougie = $this->createForm(FiltreBougieType::class, $filtre);
        $formFiltreBougie->handleRequest($request);
        $bougies = $repo->ListeBougies($filtre);
    
           

        return $this->render('admin/bougie/listeBougies.html.twig', [
            'lesBougies' => $bougies,
            'FiltreBougie' => $formFiltreBougie->createView()
        ]);
    }

    #[Route('/admin/bougie/ajout', name: 'admin_bougie_ajout', methods:["GET","POST"])]
    #[Route('/admin/bougie/modif/{id}', name: 'admin_bougie_modif', methods:["GET","POST"])]
    public function ajoutBougie(Bougie $Bougie = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        if ($Bougie == null) {
            $Bougie = new Bougie();
            $mode = "ajouté";
        } else {
            $mode = "modifié";
        }
        $form = $this->createForm(BougieType::class, $Bougie);
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
                $Bougie->setImageFilename($newFilename);
            }

            $manager->persist($Bougie);
            $manager->flush();
             $this->addFlash("success","La bougie a été $mode");
            return$this->redirectToRoute('admin_Bougie');
        }
        return $this->render('admin/Bougie/formAjoutModifBougie.html.twig', [
            'formBougie' => $form->createView()
        ]);
    }

    #[Route('/admin/bougie/suppr/{id}', name: 'admin_bougie_suppr', methods: ["GET"])]
    public function supprBougie(Bougie $bougie, EntityManagerInterface $manager)
    {
            $manager->remove($bougie);
            $manager->flush(); 
            $this->addFlash("success","La bougie a été supprimée");
            return$this->redirectToRoute('admin_Bougie');

    }

}
