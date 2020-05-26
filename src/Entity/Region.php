<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Viande::class, inversedBy="regions")
     */
    private $viandes;

    public function __construct()
    {
        $this->viandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Viande[]
     */
    public function getViandes(): Collection
    {
        return $this->viandes;
    }

    public function addViande(Viande $viande): self
    {
        if (!$this->viandes->contains($viande)) {
            $this->viandes[] = $viande;
        }

        return $this;
    }

    public function removeViande(Viande $viande): self
    {
        if ($this->viandes->contains($viande)) {
            $this->viandes->removeElement($viande);
        }

        return $this;
    }
}
