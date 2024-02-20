<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $type1 = new Type();
         $type1->setLibelle("Fruits")
                ->setImage("fruits.jpg");
         $manager->persist($type1);

         $type2 = new Type();
         $type2->setLibelle("Légumes")
                ->setImage("legumes.jpg");
         $manager->persist($type2);

         //Recuperer un aliment a partir repository
         $alimentRepository = $manager->getRepository(Aliment::class);

         $a1 = $alimentRepository->findOneBy(["nom" => "Patates"]);
         $a1->settype($type2);
         $manager->persist($a1);

         $a2 = $alimentRepository->findOneBy(["nom" => "Carottes"]);
         $a2->settype($type2);
         $manager->persist($a2);

         $a3 = $alimentRepository->findOneBy(["nom" => "Pommes"]);
         $a3->settype($type1);
         $manager->persist($a3);

         $a4 = $alimentRepository->findOneBy(["nom" => "Tomates"]);
         $a4->settype($type1);
         $manager->persist($a4);

        $manager->flush();
    }
}
