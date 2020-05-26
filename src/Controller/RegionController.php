<?php

namespace App\Controller;

use App\Entity\Region;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegionController extends AbstractController
{
    /**
     * @Route("/regions", name="regions")
     */
    public function index(RegionRepository $repository)
    {
        $regions = $repository->findAll();
        return $this->render('region/regions.html.twig', [
            'controller_name' => 'RegionController',
            'regions' => $regions
        ]);
    }

    /**
     * @Route("/region/{id}", name="afficher_region")
     */
    public function afficherRegion(Region $region)
    {
        return $this->render('region/afficherRegion.html.twig', [
            'controller_name' => 'RegionController',
            'region' => $region
        ]);
    }
}
