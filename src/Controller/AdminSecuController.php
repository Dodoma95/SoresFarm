<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $passwordCrypte = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($passwordCrypte);
            $user->setRoles('ROLE_USER')->setUpdatedAt(new \DateTime('now'))->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash("success", "Votre compte a bien été crée");
            return $this->redirectToRoute('accueil');
        }

        return $this->render('admin_secu/signup.html.twig', [
            'controller_name' => 'AdminSecuController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $util){
        $this->addFlash("success", "Vous êtes bien connecté");
        return $this->render("admin_secu/login.html.twig",[
            'lastUserName' => $util->getLastUsername(),
            'error' => $util->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
    }
}
