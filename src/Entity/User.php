<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields={"username"},
 * message="L'utilisateur existe déjà"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=15,minMessage="Le nom d'utilisateur doit faire plus de 5 caractères",maxMessage="Le nom d'utilisateur ne peut excéder 15 caractères")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=15,minMessage="Le mot de passe doit faire plus de 5 caractères",maxMessage="Le mot de passe ne peut excéder 15 caractères")
     */
    private $password;

    /**
     * @Assert\Length(min=5,max=15,minMessage="Le mot de passe doit faire plus de 5 caractères",maxMessage="Le mot de passe ne peut excéder 15 caractères")
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe doivent être équivalents")
     */
    private $verifyPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity=UserAbonnement::class, mappedBy="user")
     */
    private $userAbonnements;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct()
    {
        $this->userAbonnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerifyPassword(): ?string
    {
        return $this->verifyPassword;
    }

    public function setVerifyPassword(string $verifyPassword): self
    {
        $this->verifyPassword = $verifyPassword;

        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function getSalt()
    {

    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(?string $roles): self
    {
        if($roles === null){
            $this->roles = "ROLE_USER";
        } else {
            $this->roles = $roles;
        }

        return $this;
    }

    /**
     * @return Collection|UserAbonnement[]
     */
    public function getUserAbonnements(): Collection
    {
        return $this->userAbonnements;
    }

    public function addUserAbonnement(UserAbonnement $userAbonnement): self
    {
        if (!$this->userAbonnements->contains($userAbonnement)) {
            $this->userAbonnements[] = $userAbonnement;
            $userAbonnement->setUser($this);
        }

        return $this;
    }

    public function removeUserAbonnement(UserAbonnement $userAbonnement): self
    {
        if ($this->userAbonnements->contains($userAbonnement)) {
            $this->userAbonnements->removeElement($userAbonnement);
            // set the owning side to null (unless already changed)
            if ($userAbonnement->getUser() === $this) {
                $userAbonnement->setUser(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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
