<?php

namespace App\Entity;

use App\Repository\DessertsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DessertsRepository::class)]
class Desserts
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

    #[ORM\ManyToMany(targetEntity: Formules::class, mappedBy: 'desserts')]
    private Collection $formules;

    public function __construct()
    {
        $this->formules = new ArrayCollection();
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
     * @return Collection<int, Formules>
     */
    public function getFormules(): Collection
    {
        return $this->formules;
    }

    public function addFormule(Formules $formule): self
    {
        if (!$this->formules->contains($formule)) {
            $this->formules->add($formule);
            $formule->addDessert($this);
        }

        return $this;
    }

    public function removeFormule(Formules $formule): self
    {
        if ($this->formules->removeElement($formule)) {
            $formule->removeDessert($this);
        }

        return $this;
    }

}
