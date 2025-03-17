<?php

namespace App\Entity;

use App\Repository\ObjetDecorationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetDecorationRepository::class)]
class ObjetDecoration extends Produit
{

    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

}
