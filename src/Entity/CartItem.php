<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cart = null;

    #[ORM\ManyToOne(targetEntity: Bougie::class, inversedBy: 'cartItems')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Bougie $bougie = null;

    #[ORM\ManyToOne(targetEntity: ObjetDecoration::class, inversedBy: 'cartItems')]
    #[ORM\JoinColumn(nullable: true)]
    private ?ObjetDecoration $objectDecoration = null;

    #[ORM\ManyToOne(targetEntity: Poudre::class, inversedBy: 'cartItems')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Poudre $poudre = null;

    #[ORM\ManyToOne(targetEntity: Fondant::class, inversedBy: 'cartItems')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Fondant $fondant = null;

    #[ORM\Column(type: "integer", options: ["unsigned" => true, "default" => 1])]
    private int $quantity = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;
        return $this;
    }

    public function getBougie(): ?Bougie
    {
        return $this->bougie;
    }

    public function setBougie(?Bougie $bougie): self
    {
        $this->bougie = $bougie;
        return $this;
    }

    public function getObjectDecoration(): ?ObjetDecoration
    {
        return $this->objectDecoration;
    }

    public function setObjectDecoration(?ObjetDecoration $objectDecoration): self
    {
        $this->objectDecoration = $objectDecoration;
        return $this;
    }

    public function getPoudre(): ?Poudre
    {
        return $this->poudre;
    }

    public function setPoudre(?Poudre $poudre): self
    {
        $this->poudre = $poudre;
        return $this;
    }

    public function getFondant(): ?Fondant
    {
        return $this->fondant;
    }

    public function setFondant(?Fondant $fondant): self
    {
        $this->fondant = $fondant;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function incrementQuantity(): self
    {
        $this->quantity++;
        return $this;
    }
}


    
