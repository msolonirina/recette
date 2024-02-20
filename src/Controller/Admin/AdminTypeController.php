<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\FormType as FormType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypeController extends AbstractController
{
    #[Route('/admin/type', name: 'admin_type')]
    public function index(TypeRepository $typeRepository): Response
    {
        $listTypes = $typeRepository->findAll();

        return $this->render('type/adminType.html.twig', [
            'listTypes' => $listTypes,
        ]);
    }


    #[Route('/admin/ajoutType', name: 'ajout_type')]
    public function ajoutType(TypeRepository $typeRepository, Request $request, EntityManagerInterface $objectManager): Response
    {
        $type = new Type();
        $formType = $this->createForm(FormType::class, $type);
        $formType->handleRequest($request);
        //si formulaire valide et a été soumis
        if($formType->isSubmitted() && $formType->isValid()){
            $objectManager->persist($type);
            $objectManager->flush();
            $this->addFlash("success", "L'ajout a été effectué");
            return $this->redirectToRoute("admin_type");
        }
        return $this->render('type/ajoutType.html.twig', [
            'form' => $formType->createView(), 
            'type' => $type
        ]);
    }


    #[Route('/admin/modifierType/{id}', name: 'modifier_type')]
    public function modifierType(TypeRepository $typeRepository, $id, Request $request, EntityManagerInterface $objectManager): Response
    {
        $type = $typeRepository->find($id);
        $formType = $this->createForm(FormType::class, $type);
        $formType->handleRequest($request);
        //si formulaire valide et a été soumis
        if($formType->isSubmitted() && $formType->isValid()){
            $objectManager->persist($type);
            $objectManager->flush();
            $this->addFlash("success", "La modification a été effectué");
            return $this->redirectToRoute("admin_type");
        }
        $listTypes = $typeRepository->findAll();

        return $this->render('type/modifierType.html.twig', [
            'form' => $formType->createView(),
            'type' => $type
        ]);
    }

    #[Route('/admin/suppressionType/{id}', name: 'suppression_type')]
    public function suppression(TypeRepository $repository, $id , Request $request, EntityManagerInterface $objectManager)
    {
        $type = $repository->find($id);
        //dd($type);
        if(!is_null($type) && ($this->isCsrfTokenValid("SUP".$type->getId(), $request->get('_token')))){
            $objectManager->remove($type);
            $objectManager->flush();      
            $this->addFlash("success", "La suppression a été effectué");
            return $this->redirectToRoute("admin_type");      
        }
        $listTypes = $repository->findAll();

        return $this->render('type/adminType.html.twig', [
            'listTypes' => $listTypes,
        ]);
        
    }
}
