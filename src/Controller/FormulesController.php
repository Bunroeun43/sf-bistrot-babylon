<?php

namespace App\Controller;

use App\Entity\Formules;
use App\Form\FormulesType;
use App\Service\FileUploader;
use App\Repository\FormulesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/formules')]
class FormulesController extends AbstractController
{
    #[Route('/', name: 'app_formules_index', methods: ['GET'])]
    public function index(FormulesRepository $formulesRepository): Response
    {
        return $this->render('formules/index.html.twig', [
            'formules' => $formulesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formules_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FileUploader $fileUploader, FormulesRepository $formulesRepository): Response
    {
        $formules = new Formules();
        $form = $this->createForm(FormulesType::class, $formules);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère le fichier présent dans le formulaire
            $picture = $form->get('photo')->getData();
            // si le champs picture est renseigné (si $picture existe)
            if($picture){
                // on récupère le nom du fichier téléversé en même temps qu'il est placé dans le dossier public/uploads/images/
                $fileName = $fileUploader->upload($picture);
                // on renseigne la propriété picture de l'article avec ce nom de fichier.
                $formules->setPhoto($fileName);
            }
            $formulesRepository->add($formules, true);

            return $this->redirectToRoute('app_formules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formules/new.html.twig', [
            'formules' => $formules,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formules_show', methods: ['GET'])]
    public function show(Formules $formules): Response
    {
        return $this->render('formules/show.html.twig', [
            'formules' => $formules,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formules_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formules $formules, FileUploader $fileUploader, FormulesRepository $formulesRepository): Response
    {
        $form = $this->createForm(FormulesType::class, $formules);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère le fichier présent dans le formulaire
            $picture = $form->get('photo')->getData();
            // si le champs picture est renseigné (si $picture existe)
            if($picture){
                // on récupère le nom du fichier téléversé en même temps qu'il est placé dans le dossier public/uploads/images/
                $fileName = $fileUploader->upload($picture);
                // on renseigne la propriété picture de l'article avec ce nom de fichier.
                $formules->setPhoto($fileName);
            }
            $formulesRepository->add($formules, true);

            return $this->redirectToRoute('app_formules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formules/edit.html.twig', [
            'formules' => $formules,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formules_delete', methods: ['POST'])]
    public function delete(Request $request, Formules $formules, FormulesRepository $formulesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formules->getId(), $request->request->get('_token'))) {
            $formulesRepository->remove($formules, true);
        }

        return $this->redirectToRoute('app_formules_index', [], Response::HTTP_SEE_OTHER);
    }
}
