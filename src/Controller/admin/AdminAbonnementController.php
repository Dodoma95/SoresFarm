<?php

namespace App\Controller\admin;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAbonnementController extends AbstractController
{
    /**
     * @Route("/admin/abonnement", name="AdminAbonnement")
     */
    public function index(AbonnementRepository $repository)
    {
        $abos = $repository->findAll();
        return $this->render('admin/admin_abonnement/AdminAbonnement.html.twig', [
            'controller_name' => 'AdminAbonnementController',
            'abos' => $abos
        ]);
    }

    /**
     * @Route("/admin/abonnement/create", name="CreateAbonnement")
     * @Route("/admin/abonnement/{id}", name="AdminAbonnementModification", methods="GET|POST")
     */
    public function ajoutEtModificationAbonnement(Abonnement $abo = null, Request $request, EntityManagerInterface $entityManager)
    {
        if(!$abo) {
            $abo = new Abonnement();
        }

        $form = $this->createForm(AbonnementType::class, $abo);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $abo->getId() !== null;
            $entityManager->persist($abo);
            $entityManager->flush();
            $this->addFlash("success", ($modif) ? "La modification a bien été effectuée" : "L'ajout a bien été effectué");
            return $this->redirectToRoute('AdminAbonnement');
        }

        return $this->render('admin/admin_abonnement/AdminAbonnementModification.html.twig', [
            'controller_name' => 'AdminAbonnementController',
            'abo' => $abo,
            'form' => $form->createView(),
            'isModification' => $abo->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/abonnement/{id}", name="AdminAbonnementSuppression", methods="delete")
     */
    public function suppressionAbonnement(Abonnement $abo, Request $request, EntityManagerInterface $entityManager)
    {
        if($this->isCsrfTokenValid('delete'. $abo->getId(), $request->get('_token'))) {
            $entityManager->remove($abo);
            $entityManager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute("AdminAbonnement");
        }
    }
}
