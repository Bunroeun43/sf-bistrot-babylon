<?php

namespace App\Controller;

use App\Entity\Desserts;
use App\Form\DessertsType;
use App\Repository\DessertsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/desserts')]
class DessertsController extends AbstractController
{
    #[Route('/', name: 'app_desserts_index', methods: ['GET'])]
    public function index(DessertsRepository $dessertsRepository): Response
    {
        return $this->render('desserts/index.html.twig', [
            'desserts' => $dessertsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_desserts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DessertsRepository $dessertsRepository): Response
    {
        $dessert = new Desserts();
        $form = $this->createForm(DessertsType::class, $dessert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dessertsRepository->add($dessert, true);

            return $this->redirectToRoute('app_desserts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('desserts/new.html.twig', [
            'dessert' => $dessert,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_desserts_show', methods: ['GET'])]
    public function show(Desserts $dessert): Response
    {
        return $this->render('desserts/show.html.twig', [
            'dessert' => $dessert,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_desserts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Desserts $dessert, DessertsRepository $dessertsRepository): Response
    {
        $form = $this->createForm(DessertsType::class, $dessert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dessertsRepository->add($dessert, true);

            return $this->redirectToRoute('app_desserts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('desserts/edit.html.twig', [
            'dessert' => $dessert,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_desserts_delete', methods: ['POST'])]
    public function delete(Request $request, Desserts $dessert, DessertsRepository $dessertsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dessert->getId(), $request->request->get('_token'))) {
            $dessertsRepository->remove($dessert, true);
        }

        return $this->redirectToRoute('app_desserts_index', [], Response::HTTP_SEE_OTHER);
    }
}
