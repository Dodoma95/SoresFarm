<?php

namespace App\Controller\admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminOptionController extends AbstractController
{
    /**
     * @Route("/admin/option", name="AdminOption")
     */
    public function index(OptionRepository $repository)
    {
        $opts = $repository->findAll();
        return $this->render('admin/admin_option/AdminOption.html.twig', [
            'controller_name' => 'AdminAbonnementController',
            'opts' => $opts
        ]);
    }

    /**
     * @Route("/admin/option/create", name="CreateOption")
     * @Route("/admin/option/{id}", name="AdminOptionModification", methods="GET|POST")
     */
    public function ajoutEtModificationOption(Option $opt = null, Request $request, EntityManagerInterface $entityManager)
    {
        if(!$opt) {
            $opt = new Option();
        }

        $form = $this->createForm(OptionType::class, $opt);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $opt->getId() !== null;
            $entityManager->persist($opt);
            $entityManager->flush();
            $this->addFlash("success", ($modif) ? "La modification a bien été effectuée" : "L'ajout a bien été effectué");
            return $this->redirectToRoute('AdminOption');
        }

        return $this->render('admin/admin_option/AdminOptionModification.html.twig', [
            'controller_name' => 'AdminOptionController',
            'opt' => $opt,
            'form' => $form->createView(),
            'isModification' => $opt->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/option/{id}", name="AdminOptionSuppression", methods="delete")
     */
    public function suppressionOption(Option $opt, Request $request, EntityManagerInterface $entityManager)
    {
        if($this->isCsrfTokenValid('delete'. $opt->getId(), $request->get('_token'))) {
            $entityManager->remove($opt);
            $entityManager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute("AdminOption");
        }
    }
}
