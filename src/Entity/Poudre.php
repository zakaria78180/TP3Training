<?php

namespace App\Entity;

use App\Repository\PoudreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoudreRepository::class)]
class Poudre extends Produit
{


    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\Column]
    private ?float $poids = null;

    #[ORM\Column]
    private ?int $dureeDeVie = null;

    #[ORM\Column]
    private ?float $taille = null;


    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getDureeDeVie(): ?int
    {
        return $this->dureeDeVie;
    }

    public function setDureeDeVie(int $dureeDeVie): static
    {
        $this->dureeDeVie = $dureeDeVie;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

}
