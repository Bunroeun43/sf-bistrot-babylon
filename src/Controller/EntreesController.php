<?php

namespace App\Controller;

use App\Entity\Entrees;
use App\Form\EntreesType;
use App\Repository\EntreesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entrees')]
class EntreesController extends AbstractController
{
    #[Route('/', name: 'app_entrees_index', methods: ['GET'])]
    public function index(EntreesRepository $entreesRepository): Response
    {
        return $this->render('entrees/index.html.twig', [
            'entrees' => $entreesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_entrees_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntreesRepository $entreesRepository): Response
    {
        $entree = new Entrees();
        $form = $this->createForm(EntreesType::class, $entree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entreesRepository->add($entree, true);

            return $this->redirectToRoute('app_entrees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entrees/new.html.twig', [
            'entree' => $entree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrees_show', methods: ['GET'])]
    public function show(Entrees $entree): Response
    {
        return $this->render('entrees/show.html.twig', [
            'entree' => $entree,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entrees_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entrees $entree, EntreesRepository $entreesRepository): Response
    {
        $form = $this->createForm(EntreesType::class, $entree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entreesRepository->add($entree, true);

            return $this->redirectToRoute('app_entrees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entrees/edit.html.twig', [
            'entree' => $entree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrees_delete', methods: ['POST'])]
    public function delete(Request $request, Entrees $entree, EntreesRepository $entreesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entree->getId(), $request->request->get('_token'))) {
            $entreesRepository->remove($entree, true);
        }

        return $this->redirectToRoute('app_entrees_index', [], Response::HTTP_SEE_OTHER);
    }
}
