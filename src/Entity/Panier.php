<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users")
     */
    private $Utilisateur;

    /**
     * @ORM\Column(type="date")
     */
    private $dateachat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContenuPanier", inversedBy="Panier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $no;

    public function __construct()
    {
        $this->Utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUtilisateur(): Collection
    {
        return $this->Utilisateur;
    }

    public function addUtilisateur(Users $utilisateur): self
    {
        if (!$this->Utilisateur->contains($utilisateur)) {
            $this->Utilisateur[] = $utilisateur;
        }

        return $this;
    }

    public function removeUtilisateur(Users $utilisateur): self
    {
        if ($this->Utilisateur->contains($utilisateur)) {
            $this->Utilisateur->removeElement($utilisateur);
        }

        return $this;
    }

    public function getDateachat(): ?\DateTimeInterface
    {
        return $this->dateachat;
    }

    public function setDateachat(\DateTimeInterface $dateachat): self
    {
        $this->dateachat = $dateachat;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->Etat;
    }

    public function setEtat(bool $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getNo(): ?ContenuPanier
    {
        return $this->no;
    }

    public function setNo(?ContenuPanier $no): self
    {
        $this->no = $no;

        return $this;
    }
}
