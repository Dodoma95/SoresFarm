<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DisposeRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=DisposeRepository::class)
 * @UniqueEntity(fields={"farmer","viande"})
 * @UniqueEntity(fields={"farmer","fruit"})
 */
class Dispose
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Viande::class, inversedBy="disposes")
     */
    private $viande;

    /**
     * @ORM\ManyToOne(targetEntity=Fruit::class, inversedBy="disposes")
     */
    private $fruit;

    /**
    * @ORM\ManyToOne(targetEntity=Legume::class, inversedBy="disposes")
    */
    private $legume;

    /**
     * @ORM\ManyToOne(targetEntity=Farmer::class, inversedBy="disposes")
     */
    private $farmer;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberViande;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberFruit;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberLegume;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getViande(): ?Viande
    {
        return $this->viande;
    }

    public function setViande(?Viande $viande): self
    {
        $this->viande = $viande;

        return $this;
    }

    public function getFruit(): ?Fruit
    {
        return $this->fruit;
    }

    public function setFruit(?Fruit $fruit): self
    {
        $this->fruit = $fruit;

        return $this;
    }

    public function getLegume(): ?Legume
    {
        return $this->legume;
    }

    public function setLegume(?Legume $legume): self
    {
        $this->legume = $legume;

        return $this;
    }

    public function getFarmer(): ?Farmer
    {
        return $this->farmer;
    }

    public function setFarmer(?Farmer $farmer): self
    {
        $this->farmer = $farmer;

        return $this;
    }

    public function getNumberViande(): ?int
    {
        return $this->numberViande;
    }

    public function setNumberViande(int $numberViande): self
    {
        $this->numberViande = $numberViande;

        return $this;
    }

    public function getNumberFruit(): ?int
    {
        return $this->numberFruit;
    }

    public function setNumberFruit(int $numberFruit): self
    {
        $this->numberFruit = $numberFruit;

        return $this;
    }

    public function getNumberLegume(): ?int
    {
        return $this->numberLegume;
    }

    public function setNumberLegume(int $numberLegume): self
    {
        $this->numberLegume = $numberLegume;

        return $this;
    }
}
