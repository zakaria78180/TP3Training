<?php

namespace App\Entity;

use App\Repository\BougieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BougieRepository::class)]
class Bougie extends Produit
{
    
    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $poid = null;

    #[ORM\Column(length: 255)]
    private ?string $Ddv = null;

    #[ORM\Column(length: 255)]
    private ?string $taille = null;

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPoid(): ?string
    {
        return $this->poid;
    }

    public function setPoid(string $poid): static
    {
        $this->poid = $poid;

        return $this;
    }

    public function getDdv(): ?string
    {
        return $this->Ddv;
    }

    public function setDdv(string $Ddv): static
    {
        $this->Ddv = $Ddv;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

}
