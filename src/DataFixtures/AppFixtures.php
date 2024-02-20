<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $a1 = new Aliment();
        $a1->setNom("Carottes")
            ->setCalorie(380)
            ->setGlucides(4.5)
            ->setLipides(8.1)
            ->setPrix(1.89)
            ->setProteine(5)
            ->setImage("aliments/carotte.png");
        $manager->persist($a1);

        $a2 = new Aliment();
        $a2->setNom("Patates")
            ->setCalorie(250)
            ->setGlucides(7.5)
            ->setLipides(3.1)
            ->setPrix(6.25)
            ->setProteine(3.2)
            ->setImage("aliments/patate.jpg");
        $manager->persist($a2);

        $a3 = new Aliment();
        $a3->setNom("Pommes")
            ->setCalorie(20)
            ->setGlucides(3.2)
            ->setLipides(8.3)
            ->setPrix(2.4)
            ->setProteine(12.5)
            ->setImage("aliments/pomme.png");
        $manager->persist($a3);


        $a4 = new Aliment();
        $a4->setNom("Tomates")
            ->setCalorie(100)
            ->setGlucides(9.2)
            ->setLipides(5)
            ->setPrix(2.8)
            ->setProteine(3)
            ->setImage("aliments/tomate.png");
        $manager->persist($a4);

        $manager->flush();
    }
}
