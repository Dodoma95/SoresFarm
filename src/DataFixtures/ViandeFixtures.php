<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Dispose;
use App\Entity\Farmer;
use App\Entity\Region;
use App\Entity\Viande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ViandeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $f1 = new Farmer();
        $f1->setName("Alex le colapsologue");
        $manager->persist($f1);

        $f2 = new Farmer();
        $f2->setName("Ejide le byker");
        $manager->persist($f2);

        $f3 = new Farmer();
        $f3->setName("Elisa la fermière");
        $manager->persist($f3);

        $r1 = new Region();
        $r1->setName("Val d'oise");
        $manager->persist($r1);

        $r2 = new Region();
        $r2->setName("PACA");
        $manager->persist($r2);

        $r3 = new Region();
        $r3->setName("Aquitaine");
        $manager->persist($r3);

        $a1 = new Animal();
        $a1->setName("Poulet")
            ->setDescription("Volaille fermière nourrie aux grains bio");
        $manager->persist($a1);

        $a2 = new Animal();
        $a2->setName("Boeuf")
            ->setDescription("Boeuf de l'Oise élevé dans le plus grand respect des normes AOP");
        $manager->persist($a2);

        $v1 = new Viande();
        $v1->setName("Escalope")
            ->setAnimal("Poulet")
            ->setDescription("Volaille 100% fermier de qualité !")
            ->setImage("escalope_poulet.jpg")
            ->setPoids(1)
            ->setDisponible(true)
            ->setTypeanimal($a1)
            ->addRegion($r1)
            ->addRegion($r2)
            ->addRegion($r3);
        $manager->persist($v1);

        $v2 = new Viande();
        $v2->setName("Côte de boeuf")
            ->setAnimal("Boeuf")
            ->setDescription("Boeuf fermier, viande au top")
            ->setImage("cote_de_boeuf.jpg")
            ->setPoids(2)
            ->setDisponible(true)
            ->setTypeanimal($a2)
            ->addRegion($r1)
            ->addRegion($r2);
        $manager->persist($v2);

        $v3 = new Viande();
        $v3->setName("Kefta")
            ->setAnimal("Boeuf")
            ->setDescription("Kefta préparé maison avec épices")
            ->setImage("kefta.jpg")
            ->setPoids(1)
            ->setDisponible(true)
            ->setTypeanimal($a2)
            ->addRegion($r1)
            ->addRegion($r3);
        $manager->persist($v3);

        $v4 = new Viande();
        $v4->setName("Merguez")
            ->setAnimal("Boeuf")
            ->setDescription("Merguez supra piquante !!")
            ->setImage("merguez.jpg")
            ->setPoids(1)
            ->setDisponible(true)
            ->setTypeanimal($a2)
            ->addRegion($r1);
        $manager->persist($v4);

        $v5 = new Viande();
        $v5->setName("Trippes")
            ->setAnimal("Poulet")
            ->setDescription("Excellents abats")
            ->setImage("trippes.jpg")
            ->setPoids(5)
            ->setDisponible(false)
            ->setTypeanimal($a1)
            ->addRegion($r1)
            ->addRegion($r2);
        $manager->persist($v5);

        $d1 = new Dispose();
        $d1->setFarmer($f1)
            ->setViande($v1)
            ->setNumber(150);
        $manager->persist($d1);

        $d2 = new Dispose();
        $d2->setFarmer($f2)
            ->setViande($v2)
            ->setNumber(1000);
        $manager->persist($d2);

        $d3 = new Dispose();
        $d3->setFarmer($f3)
            ->setViande($v3)
            ->setNumber(60);
        $manager->persist($d3);

        $d4 = new Dispose();
        $d4->setFarmer($f1)
            ->setViande($v4)
            ->setNumber(78);
        $manager->persist($d4);

        $d5 = new Dispose();
        $d5->setFarmer($f2)
            ->setViande($v5)
            ->setNumber(65);
        $manager->persist($d5);

        $d6 = new Dispose();
        $d6->setFarmer($f3)
            ->setViande($v1)
            ->setNumber(567);
        $manager->persist($d6);

        $d7 = new Dispose();
        $d7->setFarmer($f1)
            ->setViande($v2)
            ->setNumber(789);
        $manager->persist($d7);

        $manager->flush();
    }
}
