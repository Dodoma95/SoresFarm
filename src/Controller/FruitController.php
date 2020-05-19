<?php

namespace App\Controller;

use App\Entity\Legume;
use App\Entity\Fruit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FruitController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'FruitController',
        ]);
    }

    /**
     * @Route("/legume", name="legume")
     */
    public function legume()
    {
        Legume::CreerLegume();
        return $this->render('pages/legume.html.twig', [
            'controller_name' => 'FruitController',
            "legumes" => Legume::$legumes
        ]);
    }

    /**
     * @Route("/legume/{name}", name="afficher_legume")
     */
    public function afficherLegume($name)
    {
        Legume::CreerLegume();
        $legume = Legume::getLegumeByName($name);
        return $this->render('pages/showLegume.html.twig', [
            'controller_name' => 'FruitController',
            "legume" => $legume
        ]);
    }

    /**
     * @Route("/fruit", name="fruit")
     */
    public function fruit()
    {
        Fruit::CreerFruit();
        return $this->render('pages/fruit.html.twig', [
            'controller_name' => 'FruitController',
            'fruits' => Fruit::$fruits
        ]);
    }

    /**
     * @Route("/fruit/{name}", name="afficher_fruit")
     */
    public function afficherFruit($name)
    {
        Fruit::CreerFruit();
        $fruit = Fruit::getFruitByName($name);
        return $this->render('pages/showFruit.html.twig', [
            'controller_name' => 'FruitController',
            "fruit" => $fruit
        ]);
    }
}
