<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    #[Route('/type', name: 'types')]
    public function index(TypeRepository $typeRepository): Response
    {
        $listTypes = $typeRepository->findAll();
        return $this->render('type/types.html.twig', [
            'listTypes' => $listTypes,
        ]);
    }
}
