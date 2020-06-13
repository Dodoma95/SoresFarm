<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    /**
     * @Route("/abonnements", name="abonnements")
     */
    public function displayAbos(AbonnementRepository $repository)
    {
        $abos = $repository->findAll();

        return $this->render('abonnement/abonnements.html.twig', [
            'controller_name' => 'AbonnementController',
            'abos' => $abos
        ]);
    }

    /**
     * @Route("/abonnement/{id}", name="afficher_abonnement")
     */
    public function afficherAbonnement(Abonnement $abo)
    {
        $lipsum = simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=paras&start=0')->lipsum;
        return $this->render('abonnement/afficherAbonnement.html.twig', [
            'controller_name' => 'FruitController',
            'abo' => $abo,
            'lipsum' => $lipsum
        ]);
    }
}
