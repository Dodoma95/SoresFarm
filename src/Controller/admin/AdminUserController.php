<?php

namespace App\Controller\admin;

use App\Entity\User;
use App\Form\SignUpType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="AdminUser")
     */
    public function index(UserRepository $repository)
    {
        $users = $repository->findAll();

        return $this->render('admin/admin_user/AdminUser.html.twig', [
            'controller_name' => 'AdminUserController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/user/{id}", name="AdminUserRoleModification", methods="GET|POST")
     */
    public function ModificationUserRole(User $user, UserRepository $repository, EntityManagerInterface $entityManager)
    {
        $userChoice = $repository->find($user->getId());

        if($userChoice->getRoles()[0] === 'ROLE_USER') {
            $userChoice->setRoles('ROLE_ADMIN');
            $entityManager->persist($userChoice);
            $entityManager->flush();
            $this->addFlash("success", "Cet utilisateur a désormais le rôle admin");
            return $this->redirectToRoute('AdminUser');
        } else {
            $userChoice->setRoles('ROLE_USER');
            $entityManager->persist($userChoice);
            $entityManager->flush();
            $this->addFlash("success", "Cet utilisateur a désormais le rôle user");
            return $this->redirectToRoute('AdminUser');
        }

        //return $this->render('admin/admin_user/AdminUser.html.twig', [
        //    'controller_name' => 'AdminUserController',
        //    'user' => $user
        //]);
    }

    /**
     * @Route("/admin/user/{id}", name="AdminUserSuppression", methods="delete")
     */
    public function suppressionUser(User $user, Request $request, EntityManagerInterface $entityManager)
    {
        if($this->isCsrfTokenValid('delete'. $user->getId(), $request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute("AdminUser");
        }
    }
}
