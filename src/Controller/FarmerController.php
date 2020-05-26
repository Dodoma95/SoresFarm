<?php

namespace App\Controller;

use App\Entity\Farmer;
use App\Repository\FarmerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FarmerController extends AbstractController
{
    /**
     * @Route("/farmers", name="farmers")
     */
    public function index(FarmerRepository $repository)
    {
        $farmers = $repository->findAll();
        return $this->render('farmer/farmers.html.twig', [
            'controller_name' => 'FarmerController',
            'farmers' => $farmers
        ]);
    }

    /**
     * @Route("/farmer/{id}", name="afficher_farmer")
     */
    public function afficherFarmer(Farmer $farmer)
    {
        return $this->render('farmer/afficherFarmer.html.twig', [
            'controller_name' => 'FarmerController',
            'farmer' => $farmer
        ]);
    }
}
