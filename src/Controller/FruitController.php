<?php

namespace App\Controller;

use App\Entity\Legume;
use App\Entity\Fruit;
use App\Repository\FruitRepository;
use App\Repository\LegumeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FruitController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render('pages/accueil.html.twig', [
            'controller_name' => 'FruitController',
        ]);
    }

    /**
     * @Route("/fruits", name="fruits")
     */
    public function index(FruitRepository $repository)
    {
        //$repository = $this->getDoctrine()->getRepository(Viande::class); du coup pas besoin car symfony fait le lien en l'indiquant en argument
        $fruits = $repository->findAll();
        return $this->render('fruit/fruits.html.twig', [
            'controller_name' => 'FruitController',
            'fruits' => $fruits
        ]);
    }

    /**
     * @Route("/fruit/{id}", name="afficher_fruit")
     */
    public function afficherFruit(Fruit $fruit)
    {
        //$repository = $this->getDoctrine()->getRepository(Viande::class); du coup pas besoin car symfony fait le lien en l'indiquant en argument
        //$viande = $repository->find($id); --> symfony fait le lien tout seul
        return $this->render('fruit/afficherFruit.html.twig', [
            'controller_name' => 'FruitController',
            'fruit' => $fruit
        ]);
    }

    /**
     * @Route("/legumes", name="legumes")
     */
    public function index1(LegumeRepository $repository)
    {
        //$repository = $this->getDoctrine()->getRepository(Viande::class); du coup pas besoin car symfony fait le lien en l'indiquant en argument
        $legumes = $repository->findAll();
        return $this->render('legume/legumes.html.twig', [
            'controller_name' => 'FruitController',
            'legumes' => $legumes,
            'isOrigin' => false,
            'isLessProteine' => false
        ]);
    }

    /**
     * @Route("/legume/{id}", name="afficher_legume")
     */
    public function afficherLegume(Legume $legume)
    {
        //$repository = $this->getDoctrine()->getRepository(Viande::class); du coup pas besoin car symfony fait le lien en l'indiquant en argument
        //$viande = $repository->find($id); --> symfony fait le lien tout seul
        return $this->render('legume/afficherLegume.html.twig', [
            'controller_name' => 'FruitController',
            'legume' => $legume
        ]);
    }

    /**
     * @Route("/legumes/origin/{origin}", name="legumesParOrigine")
     */
    public function legumesParOrigin(LegumeRepository $repository, $origin)
    {
        $legumes = $repository->getLegumeByOrigin('origin', '=', $origin);
        return $this->render('legume/legumes.html.twig', [
            'controller_name' => 'FruitController',
            'legumes' => $legumes,
            'isLessProteine' => false,
            'isOrigin' => true
        ]);
    }

    /**
     * @Route("/legumes/proteine/{proteine}", name="legumesMoinsDeProteine")
     */
    public function legumesMoinsDeProteine(LegumeRepository $repository, $proteine)
    {
        $legumes = $repository->getLegumeByLessProteine('proteine', '<', $proteine);
        return $this->render('legume/legumes.html.twig', [
            'controller_name' => 'FruitController',
            'legumes' => $legumes,
            'isOrigin' => false,
            'isLessProteine' => true
        ]);
    }

    ///**
    // * @Route("/legumes/{origin}", name="legumesParOrigine")
    // */
    //public function legumesParGlucide(LegumeRepository $repository, $origin)
    //{
    //    $legumes = $repository->getLegumeByOrigin('origin', '=', $origin);
    //    return $this->render('legume/legumes.html.twig', [
    //        'controller_name' => 'FruitController',
    //        'legumes' => $legumes,
    //        'isOrigin' => true
    //    ]);
    //}
}
