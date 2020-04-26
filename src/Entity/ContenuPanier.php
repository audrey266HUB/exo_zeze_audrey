<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContenuPanierRepository")
 */
class ContenuPanier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit")
     */
    private $Produit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Panier", mappedBy="no", orphanRemoval=true)
     */
    private $Panier;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantit;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    public function __construct()
    {
        $this->Produit = new ArrayCollection();
        $this->Panier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produit->contains($produit)) {
            $this->Produit->removeElement($produit);
        }

        return $this;
    }

    /**
     * @return Collection|Panier[]
     */
    public function getPanier(): Collection
    {
        return $this->Panier;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->Panier->contains($panier)) {
            $this->Panier[] = $panier;
            $panier->setNo($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->Panier->contains($panier)) {
            $this->Panier->removeElement($panier);
            // set the owning side to null (unless already changed)
            if ($panier->getNo() === $this) {
                $panier->setNo(null);
            }
        }

        return $this;
    }

    public function getQuantit(): ?int
    {
        return $this->quantit;
    }

    public function setQuantit(int $quantit): self
    {
        $this->quantit = $quantit;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }
}
