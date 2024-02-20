<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager)
    {
        
    }

    #[Route('/', name: 'aliments')]
    public function index(AlimentRepository $repository): Response
    {
        //dd('test');
        $listAliments = $repository->findAll();
        return $this->render('aliment/aliment.html.twig', [
            'listAliments' => $listAliments,
            'isCalorie' => false,
            'isGlucide'=> false
        ]);
    }

    #[Route('aliments/calorie/{calorie}', name: 'alimentsParCalorie')]
    public function alimentMoinsCalorique(AlimentRepository $repository, $calorie): Response
    {
        $listAliments = $repository->getAlimentParPropriete('calorie', '<', $calorie);
        return $this->render('aliment/aliment.html.twig', [
            'listAliments' => $listAliments,
            'isCalorie' => true, 
            'isGlucide'=> false
        ]);
    }

    #[Route('aliments/glucide/{glucide}', name: 'alimentsParGlucide')]
    public function alimentMoinsGlucides(AlimentRepository $repository, $glucide): Response
    {
        $listAliments = $repository->getAlimentParPropriete('glucides', '>', $glucide);
        return $this->render('aliment/aliment.html.twig', [
            'listAliments' => $listAliments,
            'isCalorie' => true,
            'isGlucide'=> true
        ]);
    }

    /*#[Route('/aliment/{id}', name: 'aliments')]
    public function detail(int $id): Response
    {
        /** @var Aliment $aliment 
        $aliment = $this->manager->getRepository(Aliment::class)->findOneById($id);
        $aliment->setGlucides(4.5);
        $this->manager->persist($aliment);
        $this->manager->flush();
        $aliment = $this->manager->getRepository(Aliment::class)->findOneById($id);
        dd($aliment);
        dd('test');
        return $this->render('aliment/index.html.twig', [
            'controller_name' => 'AlimentController',
        ]);
    }*/
}
