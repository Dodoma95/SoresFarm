<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class SignUpProcess
{
    private $encoder;
    private $entityManager;

    public function __construct(User $user, UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        $this->user = $user;
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    public function createUser($user)
    {
      $passwordCrypte = $this->encoder->encodePassword($user,$user->getPassword());
      $user->setPassword($passwordCrypte);
      $user->setRoles('ROLE_USER')->setUpdatedAt(new \DateTime('now'))->setCreatedAt(new \DateTime('now'));
      $this->entityManager->persist($user);
      $this->entityManager->flush();
      //dd(phpinfo()); --> sert a afficher toutes les informations du projet dont les variables d'env
    }
}
