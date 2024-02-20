<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminAlimentController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager)
    {
        
    }

    #[Route('/admin/administration', name: 'administration')]
    public function index(AlimentRepository $repository): Response
    {
         $listAliments = $repository->findAll();
         return $this->render('admin/adminAliment.html.twig', [
             'listAliments' => $listAliments
         ]);
    }

    #[Route('/admin/aliment/{id}', name: 'modification_aliment')]
    public function modification(AlimentRepository $repository, $id , Request $request, EntityManagerInterface $objectManager): Response
    {
        //dd('ici modif');
        $aliment = $repository->find($id);
        
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $objectManager->persist($aliment);
            $objectManager->flush();
            $this->addFlash("success", "La modification a été effectué");
            return $this->redirectToRoute("administration");
        }
         return $this->render('admin/modificationAliment.html.twig', [
             'aliment' => $aliment, 
             'form' => $form->createView()
         ]);
    }

    #[Route('/admin/creation', name: 'creation_aliment')]
    public function ajout(AlimentRepository $repository , $id, Request $request, EntityManagerInterface $objectManager): Response
    {
        //dd('ici ajout');
        $aliment =  new Aliment();
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $objectManager->persist($aliment);
            $objectManager->flush();
            $this->addFlash("success", "L'ajout a été effectué");
            return $this->redirectToRoute("administration");
        }
         return $this->render('admin/ajoutAliment.html.twig', [
             'aliment' => $aliment, 
             'form' => $form->createView()
         ]);
    }


    #[Route('/admin/suppression/{id}', name: 'suppression_aliment')]
    public function suppression(AlimentRepository $repository, $id , Request $request, EntityManagerInterface $objectManager)
    {
        $aliment = $repository->find($id);
       // dd($aliment);
        if(!is_null($aliment) && ($this->isCsrfTokenValid("SUP".$aliment->getId(), $request->get('_token')))){
            $objectManager->remove($aliment);
            $objectManager->flush();      
            $this->addFlash("success", "La suppression a été effectué");
            return $this->redirectToRoute("administration");      
        }
        $listAliments = $repository->findAll();
         return $this->render('admin/adminAliment.html.twig', [
             'listAliments' => $listAliments
         ]);
        
    }


}
