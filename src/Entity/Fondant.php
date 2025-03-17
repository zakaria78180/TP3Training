<?php

namespace App\Entity;

use App\Repository\FondantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FondantRepository::class)]
class Fondant extends Produit
{
   
   
    #[ORM\Column(length: 255)]
    private ?string $ddv = null;

    public function getDdv(): ?string
    {
        return $this->ddv;
    }

    public function setDdv(string $ddv): static
    {
        $this->ddv = $ddv;

        return $this;
    }
}
