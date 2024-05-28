<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Formules;
use App\Entity\LineCommande;
use App\Form\LineCommandeType;
use App\Form\CommandeValidType;
use App\Repository\CommandeRepository;
use App\Repository\lineCommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
   #[Route('/formules/{id}', name: 'app_cart_show', methods: ['GET','POST'])]
    
    public function show(Request $request, Formules $formules, LineCommandeRepository $lineCommandeRepository, CommandeRepository $commandeRepository): Response
    {
        $lineCommande = new LineCommande();
        $form = $this->createForm(LineCommandeType::class, $lineCommande);
        $form->handleRequest($request);

        $panier = $commandeRepository->findOneBy([
            'statut'=>'panier',
            'auteur'=>$this->getUser(),
        ]);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $lineCommande->setCommande($panier);
            $lineCommande->setFormules($formules);

            $lineCommandeRepository->add($lineCommande, true);

            return $this->redirectToRoute('app_panier', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('cart/show.html.twig', [
            'formules' => $formules,
            'form' => $form,
            'panier' => $panier,
        ]);
    }

    
     #[Route("/panier", name: 'app_panier', methods: ['GET', 'POST'])]
    
    public function panier(Request $request, CommandeRepository $commandeRepository): Response
    {
        $panier = $commandeRepository->findOneBy([
            'statut'=>'panier',
            'auteur'=>$this->getUser(),
        ]);

        $form = $this->createForm(CommandeValidType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // le panier devient une commande validée
            $panier->setStatut('commande validée - en attente de paiement');
            $commandeRepository->add($panier, true);

            // on doit créer un nouveau panier (une commande avec le statut 'panier', parce que l'ancien panier a changé de statut)
            $nouveauPanier = new Commande();
            $nouveauPanier->setStatut('panier');
            $nouveauPanier->setAuteur($this->getUser());
            $commandeRepository->add($nouveauPanier, true);

            return $this->redirectToRoute('app_cart', [], Response::HTTP_SEE_OTHER);
        }
            return $this->renderForm('cart/panier.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    } 
}