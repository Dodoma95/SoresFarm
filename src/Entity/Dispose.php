<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DisposeRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=DisposeRepository::class)
 * @UniqueEntity(fields={"farmer","viande"})
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
     * @ORM\ManyToOne(targetEntity=Farmer::class, inversedBy="disposes")
     */
    private $farmer;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

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

    public function getFarmer(): ?Farmer
    {
        return $this->farmer;
    }

    public function setFarmer(?Farmer $farmer): self
    {
        $this->farmer = $farmer;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
