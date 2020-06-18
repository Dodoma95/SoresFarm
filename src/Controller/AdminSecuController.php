<?php

namespace App\Controller;

use App\Entity\User;
use SendGrid\Mail\Mail;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $email = new Mail();
        $email->setFrom("soresfarm@gmx.fr", "Example User");
        $email->setSubject("Welcome to the SoresFarm");
        $email->addContent("text/plain", "Merci d'avoir choisie notre service, vous avez enfin compris ce qu'est la bonne nourriture lol");
        $email->addContent(
            "text/html", "<p>Incroyable vous êtes notre premier client</p>"
        );
        $sendgrid = new \SendGrid('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');
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            try {
                $passwordCrypte = $encoder->encodePassword($user,$user->getPassword());
                $user->setPassword($passwordCrypte);
                $user->setRoles('ROLE_USER')->setUpdatedAt(new \DateTime('now'))->setCreatedAt(new \DateTime('now'));
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash("success", "Votre compte a bien été crée");
                
                $email->addTo($user->getEmail(), "User just sign up");
                $response = $sendgrid->send($email);
                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
                return $this->redirectToRoute('accueil');
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }

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
