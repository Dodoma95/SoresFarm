<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 * @Vich\Uploadable
 */
class Abonnement
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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $optionsTab = [];

    /**
     * @ORM\OneToMany(targetEntity=UserAbonnement::class, mappedBy="abonnement")
     */
    private $userAbonnements;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="abonnement_image", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity=Option::class, inversedBy="abonnements")
     */
    private $options;

    public function __construct()
    {
        $this->userAbonnements = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        //if ($this->imageFile instanceof UploadedFile) {
        //    $this->updated_at = new \DateTime('now');
        //}
        return $this;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getOptionsTab(): ?array
    {
        return $this->optionsTab;
    }

    public function setOptionsTab(?array $optionsTab): self
    {
        $this->optionsTab = $optionsTab;

        return $this;
    }

    /**
     * @return Collection|UserAbonnement[]
     */
    public function getUserAbonnements(): Collection
    {
        return $this->userAbonnements;
    }

    public function addUserAbonnements(UserAbonnement $userAbonnement): self
    {
        if (!$this->userAbonnements->contains($userAbonnement)) {
            $this->userAbonnements[] = $userAbonnement;
            $userAbonnement->setAbonnement($this);
        }

        return $this;
    }

    public function removeUserAbonnement(UserAbonnement $UserAbonnement): self
    {
        if ($this->UserAbonnements->contains($UserAbonnement)) {
            $this->UserAbonnements->removeElement($UserAbonnement);
            // set the owning side to null (unless already changed)
            if ($UserAbonnement->getAbonnement() === $this) {
                $UserAbonnement->setAbonnement(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addAbonnement($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            $option->removeAbonnement($this);
        }

        return $this;
    }
}
