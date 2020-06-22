<?php

namespace App\Controller;

use App\Entity\User;
use SendGrid\Mail\Mail;
use App\Form\SignUpType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Service\EmailGenerator;
use App\Service\SignUpProcess;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function index(Request $request, SignUpProcess $signUpProcess, EmailGenerator $emailGenerator)
    {
        $user = new User();
        $email = new Mail();
        $sendgrid = new \SendGrid($_ENV['SENDGRID_API_KEY']);
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            try {
                $signUpProcess->createUser($user);
                $this->addFlash("success", "Votre compte a bien été crée");
                $email = $emailGenerator->generateEmail('Welcome to the SoresFarm !!', 'Félicitation, vous rentrez dans le cercle fermé des biens nourries');
                $email->addTo($user->getEmail(), $user->getUsername());
                $response = $sendgrid->send($email);
                //print $response->statusCode() . "\n";
                //print_r($response->headers());
                //print $response->body() . "\n"; --> sert a afficher informations sur le mail
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
