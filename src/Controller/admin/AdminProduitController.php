<?php

namespace App\Controller\admin;

use App\Entity\Fruit;
use App\Entity\Legume;
use App\Form\FruitType;
use App\Form\LegumeType;
use App\Repository\FruitRepository;
use App\Repository\LegumeRepository;
use App\Repository\ViandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProduitController extends AbstractController
{
    /**
     * @Route("/admin/produit", name="AdminProduit")
     */
    public function index(FruitRepository $fruitRepository, LegumeRepository $legumeRepository, ViandeRepository $viandeRepository)
    {
        $fruits = $fruitRepository->findAll();
        $legumes = $legumeRepository->findAll();
        $viandes = $viandeRepository->findAll();
        return $this->render('admin/admin_produit/AdminProduit.html.twig', [
            'controller_name' => 'AdminProduitController',
            'fruits' => $fruits,
            'legumes' => $legumes,
            'viandes' => $viandes
        ]);
    }

    /**
     * @Route("/admin/produit/fruit/create", name="CreateFruit")
     * @Route("/admin/produit/fruit/{id}", name="AdminFruitModification", methods="GET|POST")
     */
    public function ajoutEtModificationFruit(Fruit $fruit = null, Request $request, EntityManagerInterface $entityManager)
    {
        if(!$fruit) {
            $fruit = new Fruit();
        }

        $form = $this->createForm(FruitType::class, $fruit);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $fruit->getId() !== null;
            $entityManager->persist($fruit);
            $entityManager->flush();
            $this->addFlash("success", ($modif) ? "La modification a bien été effectuée" : "L'ajout a bien été effectué");
            return $this->redirectToRoute('AdminProduit');
        }

        return $this->render('admin/admin_produit/AdminFruitModification.html.twig', [
            'controller_name' => 'AdminProduitController',
            'fruit' => $fruit,
            'form' => $form->createView(),
            'isModification' => $fruit->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/produit/fruit/{id}", name="AdminFruitSuppression", methods="delete")
     */
    public function suppressionFruit(Fruit $fruit, Request $request, EntityManagerInterface $entityManager)
    {
        if($this->isCsrfTokenValid('delete'. $fruit->getId(), $request->get('_token'))) {
            $entityManager->remove($fruit);
            $entityManager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute("AdminProduit");
        }
    }

    /**
     * @Route("/admin/produit/legume/create", name="CreateLegume")
     * @Route("/admin/produit/legume/{id}", name="AdminLegumeModification", methods="GET|POST")
     */
    public function ajoutEtModificationLegume(Legume $legume = null, Request $request, EntityManagerInterface $entityManager)
    {
        if(!$legume) {
            $legume = new Legume();
        }

        $form = $this->createForm(LegumeType::class, $legume);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $legume->getId() !== null;
            $entityManager->persist($legume);
            $entityManager->flush();
            $this->addFlash("success", ($modif) ? "La modification a bien été effectuée" : "L'ajout a bien été effectué");
            return $this->redirectToRoute('AdminProduit');
        }

        return $this->render('admin/admin_produit/AdminLegumeModification.html.twig', [
            'controller_name' => 'AdminProduitController',
            'legume' => $legume,
            'form' => $form->createView(),
            'isModification' => $legume->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/produit/legume/{id}", name="AdminLegumeSuppression", methods="delete")
     */
    public function suppressionLegume(Legume $legume, Request $request, EntityManagerInterface $entityManager)
    {
        if($this->isCsrfTokenValid('delete'. $legume->getId(), $request->get('_token'))) {
            $entityManager->remove($legume);
            $entityManager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute("AdminProduit");
        }
    }
}
