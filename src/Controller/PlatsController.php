<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Form\PlatsType;
use App\Repository\PlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plats')]
class PlatsController extends AbstractController
{
    #[Route('/', name: 'app_plats_index', methods: ['GET'])]
    public function index(PlatsRepository $platsRepository): Response
    {
        return $this->render('plats/index.html.twig', [
            'plats' => $platsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plats_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlatsRepository $platsRepository): Response
    {
        $plat = new Plats();
        $form = $this->createForm(PlatsType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $platsRepository->add($plat, true);

            return $this->redirectToRoute('app_plats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plats/new.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plats_show', methods: ['GET'])]
    public function show(Plats $plat): Response
    {
        return $this->render('plats/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plats_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plats $plat, PlatsRepository $platsRepository): Response
    {
        $form = $this->createForm(PlatsType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $platsRepository->add($plat, true);

            return $this->redirectToRoute('app_plats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plats/edit.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plats_delete', methods: ['POST'])]
    public function delete(Request $request, Plats $plat, PlatsRepository $platsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $platsRepository->remove($plat, true);
        }

        return $this->redirectToRoute('app_plats_index', [], Response::HTTP_SEE_OTHER);
    }
}
