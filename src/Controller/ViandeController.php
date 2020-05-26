<?php

namespace App\Controller;

use App\Entity\Viande;
use App\Repository\ViandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViandeController extends AbstractController
{
    /**
     * @Route("/viandes", name="viandes")
     */
    public function index(ViandeRepository $repository)
    {
        //$repository = $this->getDoctrine()->getRepository(Viande::class); du coup pas besoin car symfony fait le lien en l'indiquant en argument
        $viandes = $repository->findAll();
        return $this->render('viande/viandes.html.twig', [
            'controller_name' => 'ViandeController',
            'viandes' => $viandes
        ]);
    }

    /**
     * @Route("/viande/{id}", name="afficher_viande")
     */
    public function afficherViande(Viande $viande)
    {
        //$repository = $this->getDoctrine()->getRepository(Viande::class); du coup pas besoin car symfony fait le lien en l'indiquant en argument
        //$viande = $repository->find($id); --> symfony fait le lien tout seul
        return $this->render('viande/afficherViande.html.twig', [
            'controller_name' => 'ViandeController',
            'viande' => $viande
        ]);
    }
}
