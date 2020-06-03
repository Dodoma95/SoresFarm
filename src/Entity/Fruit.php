<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FruitRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=FruitRepository::class)
 * @Vich\Uploadable
 */
class Fruit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3,max=30,minMessage="Le nom doit faire 3 caractères minimum",maxMessage="Le nom doit faire maximum 30 caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min=0.1, max=100, notInRangeMessage="Le prix ne peut être compris qu'entre {{ min }} et {{ max }}")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origin;

    /**
     * @ORM\Column(type="array")
     */
    private $skill = [];

    /**
     * @ORM\OneToMany(targetEntity=Dispose::class, mappedBy="fruit")
     */
    private $disposes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="fruit_image", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proteine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lipide;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $glucide;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct()
    {
        $this->disposes = new ArrayCollection();
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
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

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getSkill(): ?array
    {
        return $this->skill;
    }

    public function setSkill(array $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * @return Collection|Dispose[]
     */
    public function getDisposes(): Collection
    {
        return $this->disposes;
    }

    public function addDispose(Dispose $dispose): self
    {
        if (!$this->disposes->contains($dispose)) {
            $this->disposes[] = $dispose;
            $dispose->setFruit($this);
        }

        return $this;
    }

    public function removeDispose(Dispose $dispose): self
    {
        if ($this->disposes->contains($dispose)) {
            $this->disposes->removeElement($dispose);
            // set the owning side to null (unless already changed)
            if ($dispose->getFruit() === $this) {
                $dispose->setFruit(null);
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

    public function getProteine(): ?string
    {
        return $this->proteine;
    }

    public function setProteine(string $proteine): self
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getLipide(): ?string
    {
        return $this->lipide;
    }

    public function setLipide(string $lipide): self
    {
        $this->lipide = $lipide;

        return $this;
    }

    public function getGlucide(): ?string
    {
        return $this->glucide;
    }

    public function setGlucide(string $glucide): self
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
