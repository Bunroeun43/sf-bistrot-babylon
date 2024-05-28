<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $auteur = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LineCommande::class, orphanRemoval: true)]
    private Collection $lineCommandes;

    public function __construct()
    {
        $this->lineCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection<int, LineCommande>
     */
    public function getLineCommandes(): Collection
    {
        return $this->lineCommandes;
    }

    public function addLineCommande(LineCommande $lineCommande): self
    {
        if (!$this->lineCommandes->contains($lineCommande)) {
            $this->lineCommandes->add($lineCommande);
            $lineCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLineCommande(LineCommande $lineCommande): self
    {
        if ($this->lineCommandes->removeElement($lineCommande)) {
            // set the owning side to null (unless already changed)
            if ($lineCommande->getCommande() === $this) {
                $lineCommande->setCommande(null);
            }
        }

        return $this;
    }
}
