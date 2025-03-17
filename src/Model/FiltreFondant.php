<?php 

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

class FiltreFondant {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Assert\Length(
        min: 2,
        minMessage: 'The name need to be longer than {{ limit }} characters'
    )]
    public string $nom;

    }