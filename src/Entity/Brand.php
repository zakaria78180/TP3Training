<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Le nom de la marque ne peut pas être vide")]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: "Le nom de la marque doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le nom de la marque ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Produit::class)]
    private Collection $produits;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: DiffuseurVoiture::class)]
    private Collection $diffuseurVoitures;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->produits = new ArrayCollection();
        $this->diffuseurVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setBrand($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getBrand() === $this) {
                $article->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setBrand($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getBrand() === $this) {
                $produit->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DiffuseurVoiture>
     */
    public function getDiffuseurVoitures(): Collection
    {
        return $this->diffuseurVoitures;
    }

    public function addDiffuseurVoiture(DiffuseurVoiture $diffuseurVoiture): static
    {
        if (!$this->diffuseurVoitures->contains($diffuseurVoiture)) {
            $this->diffuseurVoitures->add($diffuseurVoiture);
            $diffuseurVoiture->setBrand($this);
        }

        return $this;
    }

    public function removeDiffuseurVoiture(DiffuseurVoiture $diffuseurVoiture): static
    {
        if ($this->diffuseurVoitures->removeElement($diffuseurVoiture)) {
            // set the owning side to null (unless already changed)
            if ($diffuseurVoiture->getBrand() === $this) {
                $diffuseurVoiture->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * Méthodes pour accéder aux produits spécifiques via l'héritage
     */
    
    /**
     * @return Collection<int, Fondant>
     */
    public function getFondants(): Collection
    {
        return $this->produits->filter(function($produit) {
            return $produit instanceof Fondant;
        });
    }

    /**
     * @return Collection<int, ObjetDecoration>
     */
    public function getObjetDecorations(): Collection
    {
        return $this->produits->filter(function($produit) {
            return $produit instanceof ObjetDecoration;
        });
    }

    /**
     * @return Collection<int, Poudre>
     */
    public function getPoudres(): Collection
    {
        return $this->produits->filter(function($produit) {
            return $produit instanceof Poudre;
        });
    }

    /**
     * @return Collection<int, Bougie>
     */
    public function getBougies(): Collection
    {
        return $this->produits->filter(function($produit) {
            return $produit instanceof Bougie;
        });
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }
}

