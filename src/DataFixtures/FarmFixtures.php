<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Fruit;
use App\Entity\Animal;
use App\Entity\Farmer;
use App\Entity\Legume;
use App\Entity\Option;
use App\Entity\Region;
use App\Entity\Viande;
use App\Entity\Dispose;
use App\Entity\Abonnement;
use App\Entity\UserAbonnement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FarmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $opt1 = new Option();
        $opt1->setName("Mélange de noix bio");
        $opt1->setPrice(3);
        $manager->persist($opt1);

        $opt2 = new Option();
        $opt2->setName("Miel paysan bio");
        $opt2->setPrice(5);
        $manager->persist($opt2);

        $opt3 = new Option();
        $opt3->setName("Tomate cerise");
        $opt3->setPrice(2);
        $manager->persist($opt3);

        $ab1 = new Abonnement();
        $ab1->setName("Mélange de fruits");
        $ab1->setPrice(10.99);
        $ab1->setDescription("Un mélange de fruits de saisons");
        $ab1->addOption($opt1);
        $ab1->addOption($opt2);
        $ab1->addOption($opt3);
        $manager->persist($ab1);

        $ab2 = new Abonnement();
        $ab2->setName("Mélange de légumes");
        $ab2->setPrice(13.99);
        $ab2->setDescription("Un mélange de légumes de saisons");
        $ab2->addOption($opt1);
        $ab2->addOption($opt2);
        $ab2->addOption($opt3);
        $manager->persist($ab2);

        $ab3 = new Abonnement();
        $ab3->setName("Mélange de légumes&Fruits");
        $ab3->setPrice(16.99);
        $ab3->setDescription("Un mélange de légumes et de fruits de saisons");
        $ab3->addOption($opt1);
        $ab3->addOption($opt2);
        $ab3->addOption($opt3);
        $manager->persist($ab3);

        $us1 = new User();
        $us1->setUsername('dodoma');
        $us1->setPassword('dodoma');
        $us1->setEmail("maillard.dorian60@gmail.com");
        $us1->setRoles("ROLE_ADMIN");
        $us1->setUpdatedAt(new \DateTime('now'));
        $us1->setCreatedAt(new \DateTime('now'));
        $manager->persist($us1);

        $us2 = new User();
        $us2->setUsername('sores');
        $us2->setPassword('dodoma');
        $us2->setEmail("soso@gmail.com");
        $us2->setRoles("ROLE_USER");
        $us2->setUpdatedAt(new \DateTime('now'));
        $us2->setCreatedAt(new \DateTime('now'));
        $manager->persist($us2);

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

        $fruit1 = new Fruit();
        $fruit1->setName("Fruit de la passion")
                ->setPrice(2)
                ->setOrigin("Ile de la Réunion")
                ->setImage("fruitdelapassion.jpg")
                ->setSkill([
                    'proteine' => '2.3',
                    'lipide' => '0.7',
                    'glucide' => '9.39'
                ])
                ->setProteine("2.3")
                ->setLipide("0.7")
                ->setGlucide("9.39")
                ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($fruit1);

        $fruit2 = new Fruit();
        $fruit2->setName("Grenade")
                ->setPrice(5)
                ->setOrigin("Madagascar")
                ->setImage("grenade.jpg")
                ->setSkill([
                    'proteine' => '1.29',
                    'lipide' => '0.74',
                    'glucide' => '14.2'
                ])
                ->setProteine("1.29")
                ->setLipide("0.74")
                ->setGlucide("14.2")
                ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($fruit2);

        $fruit3 = new Fruit();
        $fruit3->setName("Kiwi")
                ->setPrice(2)
                ->setOrigin("Martinique")
                ->setImage("kiwi.jpg")
                ->setSkill([
                    'proteine' => '1.2',
                    'lipide' => '0.95',
                    'glucide' => '8.44'
                ])
                ->setProteine("1.2")
                ->setLipide("0.95")
                ->setGlucide("8.44")
                ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($fruit3);

        $leg1 = new Legume();
        $leg1->setName("Courgette")
                ->setPrice(2)
                ->setOrigin("Spain")
                ->setImage("courgette.jpg")
                ->setSkill([
                    'proteine' => '0.93',
                    'lipide' => '0.36',
                    'glucide' => '1.4'
                ])
                ->setProteine("0.93")
                ->setLipide("0.36")
                ->setGlucide("1.4")
                ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($leg1);

        $leg2 = new Legume();
        $leg2->setName("Haricot")
                ->setPrice(5)
                ->setOrigin("Francia")
                ->setImage("haricot.jpg")
                ->setSkill([
                    'proteine' => '2',
                    'lipide' => '0.17',
                    'glucide' => '3'
                ])
                ->setProteine("2")
                ->setLipide("0.17")
                ->setGlucide("3")
                ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($leg2);

        $leg3 = new Legume();
        $leg3->setName("Aubergine")
                ->setPrice(2)
                ->setOrigin("Allemagne")
                ->setImage("aubergine.jpg")
                ->setSkill([
                    'proteine' => '1.23',
                    'lipide' => '0.28',
                    'glucide' => '4.16'
                ])
                ->setProteine("1.23")
                ->setLipide("0.28")
                ->setGlucide("4")
                ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($leg3);

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

        $usab1 = new UserAbonnement();
        $usab1->setOptions([
            'Fruits secs' => true
        ]);
        $usab1->setState([
            'STATE' => 'En cours'
        ]);
        $usab1->setAbonnement($ab1);
        $usab1->setUser($us2);
        $usab1->setUpdatedAt(new \DateTime('now'));
        $usab1->setCreatedAt(new \DateTime('now'));
        $manager->persist($usab1);

        $usab2 = new UserAbonnement();
        $usab2->setOptions([
            'Fruits secs' => true
        ]);
        $usab2->setState([
            'STATE' => 'En cours'
        ]);
        $usab2->setAbonnement($ab3);
        $usab2->setUser($us2);
        $usab2->setUpdatedAt(new \DateTime('now'));
        $usab2->setCreatedAt(new \DateTime('now'));
        $manager->persist($usab2);

        //$d1 = new Dispose();
        //$d1->setFarmer($f1)
        //    ->setViande($v1)
        //    ->setFruit($fruit1)
        //    ->setLegume($leg1)
        //    ->setNumberFruit(543)
        //    ->setNumberLegume(765)
        //    ->setNumberViande(150);
        //$manager->persist($d1);
//
        //$d2 = new Dispose();
        //$d2->setFarmer($f2)
        //    ->setViande($v2)
        //    ->setFruit($fruit2)
        //    ->setLegume($leg2)
        //    ->setNumberFruit(567)
        //    ->setNumberLegume(324)
        //    ->setNumberViande(1000);
        //$manager->persist($d2);
//
        //$d3 = new Dispose();
        //$d3->setFarmer($f3)
        //    ->setViande($v3)
        //    ->setFruit($fruit3)
        //    ->setLegume($leg3)
        //    ->setNumberFruit(45)
        //    ->setNumberLegume(43)
        //    ->setNumberViande(60);
        //$manager->persist($d3);
//
        //$d4 = new Dispose();
        //$d4->setFarmer($f1)
        //    ->setViande($v4)
        //    ->setFruit($fruit3)
        //    ->setLegume($leg3)
        //    ->setNumberFruit(32)
        //    ->setNumberLegume(9754)
        //    ->setNumberViande(78);
        //$manager->persist($d4);
//
        //$d5 = new Dispose();
        //$d5->setFarmer($f2)
        //    ->setViande($v5)
        //    ->setFruit($fruit1)
        //    ->setLegume($leg1)
        //    ->setNumberFruit(76)
        //    ->setNumberLegume(7643)
        //    ->setNumberViande(65);
        //$manager->persist($d5);
//
        //$d6 = new Dispose();
        //$d6->setFarmer($f3)
        //    ->setViande($v1)
        //    ->setFruit($fruit2)
        //    ->setLegume($leg2)
        //    ->setNumberFruit(5433)
        //    ->setNumberLegume(765)
        //    ->setNumberViande(567);
        //$manager->persist($d6);
//
        //$d7 = new Dispose();
        //$d7->setFarmer($f1)
        //    ->setViande($v2)
        //    ->setFruit($fruit2)
        //    ->setLegume($leg2)
        //    ->setNumberFruit(76)
        //    ->setNumberLegume(7645)
        //    ->setNumberViande(789);
        //$manager->persist($d7);

        $manager->flush();
    }
}
