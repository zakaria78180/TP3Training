<?php

namespace App\Controller\Admin;

use App\Entity\Poudre;
use App\Form\PoudreType;
use App\Repository\PoudreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class PoudreController extends AbstractController
{
    #[Route('/admin/poudre', name: 'admin_poudre', methods:"GET")]
    public function listePoudres(PoudreRepository $repo): Response
    {
        $poudres = $repo->findAll();
        return $this->render('admin/poudre/listePoudre.html.twig', [
            'lesPoudres' => $poudres
        ]);
    }
    // gérer le téléchargement et le stockage des fichiers
    #[Route('/admin/poudre/ajout', name: 'admin_poudre_ajout', methods:["GET","POST"])]
    #[Route('/admin/poudre/ajout/modif{id}', name: 'admin_poudre_modif', methods:["GET","POST"])]
    public function ajoutPoudre(Poudre $poudre = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        if ($poudre == null) {
            $poudre = new Poudre();
            $mode = "ajoutée";
        } else {
            $mode = "modifiée";
        }
        $form = $this->createForm(PoudreType::class, $poudre);
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
                $poudre->setImageFilename($newFilename);
            }

            $manager->persist($poudre);
            $manager->flush();
            $this->addFlash("success", "La poudre a bien été $mode");
            return $this->redirectToRoute('admin_poudre');
        }
        return $this->render('admin/poudre/formAjoutModifPoudre.html.twig', [
            'formPoudre' => $form->createView()
        ]);
    }

    #[Route('/admin/poudre/ajout/suppression{id}', name: 'admin_poudre_suppression', methods:"GET")]
    public function suppressionPoudre( Poudre $poudre=null, EntityManagerInterface $manager): Response
    {
            $manager->remove($poudre);
            $manager->flush();
            $this->addFlash("success", "La poudre a bien été suppression");
            return$this->redirectToRoute('admin_poudre');
    }
}
