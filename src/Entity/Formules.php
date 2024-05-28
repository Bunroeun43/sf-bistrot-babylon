<?php

namespace App\Entity;

use App\Repository\FormulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormulesRepository::class)]
class Formules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\ManyToMany(targetEntity: Entrees::class, inversedBy: 'formules')]
    private Collection $entrees;

    #[ORM\ManyToMany(targetEntity: Plats::class, inversedBy: 'formules')]
    private Collection $plats;

    #[ORM\ManyToMany(targetEntity: Desserts::class, inversedBy: 'formules')]
    private Collection $desserts;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'formule', targetEntity: LineCommande::class)]
    private Collection $lineCommandes;

    #[ORM\Column]
    private ?bool $isActive = null;

    public function __construct()
    {
        $this->entrees = new ArrayCollection();
        $this->plats = new ArrayCollection();
        $this->desserts = new ArrayCollection();
        $this->lineCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Entrees>
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(Entrees $entree): self
    {
        if (!$this->entrees->contains($entree)) {
            $this->entrees->add($entree);
        }

        return $this;
    }

    public function removeEntree(Entrees $entree): self
    {
        $this->entrees->removeElement($entree);

        return $this;
    }

    /**
     * @return Collection<int, Plats>
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plats $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats->add($plat);
        }

        return $this;
    }

    public function removePlat(Plats $plat): self
    {
        $this->plats->removeElement($plat);

        return $this;
    }

    /**
     * @return Collection<int, Desserts>
     */
    public function getDesserts(): Collection
    {
        return $this->desserts;
    }

    public function addDessert(Desserts $dessert): self
    {
        if (!$this->desserts->contains($dessert)) {
            $this->desserts->add($dessert);
        }

        return $this;
    }

    public function removeDessert(Desserts $dessert): self
    {
        $this->desserts->removeElement($dessert);

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

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
            $lineCommande->setFormule($this);
        }

        return $this;
    }

    public function removeLineCommande(LineCommande $lineCommande): self
    {
        if ($this->lineCommandes->removeElement($lineCommande)) {
            // set the owning side to null (unless already changed)
            if ($lineCommande->getFormule() === $this) {
                $lineCommande->setFormule(null);
            }
        }

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
