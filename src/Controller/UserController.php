<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserAbonnementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user_account")
     */
    public function userAccount(User $user, Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $passwordCrypte = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($passwordCrypte);
            $user->setUpdatedAt(new \DateTime('now'));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash("success", "Les modifications de votre compte ont bien été prises en compte");
            return $this->redirectToRoute('accueil');
        }

        return $this->render('user/userAccount.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/{id}/abonnement", name="user_abonnement")
     */
    public function userAbonnement(User $user, UserAbonnementRepository $repository)
    {
        $userId = $user->getId();
        $userAbonnements = $repository->getUserAbonnementByUserId($userId);

        return $this->render('user/userAbonnement.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'userAbonnements' => $userAbonnements
        ]);
    }
}
