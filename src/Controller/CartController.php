<?php

namespace App\Controller;

use App\Entity\Formules;
use App\Entity\Commande;
use App\Entity\LineCommande;
use App\Form\CommandeValidType;
use App\Form\LineCommandeType;
use App\Repository\FormulesRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    #[ParamConverter]
    public function index(FormulesRepository $formulesRepository, CommandeRepository $commandeRepository): Response
    {
            $panier = $commandeRepository->findOneBy([
                'statut'=>'panier',
                'auteur'=>$this->getUser(),
            ]);
        return $this->render('cart/index.html.twig', [
            'formules' => $formulesRepository->findBy(['isActive'=>true]),
            'panier' => $panier,
        ]);
    }

    #[Route('/commande', name: 'app_commande_index', methods: ['GET'])]
    public function commandeIndex(CommandeRepository $commandeRepository): reponse
    {
    $commandes = $commandeRepository->findOneBy([
        'au teur'=>$this->getUser(),
        'statut'=>['Commande validée - En attente de paiement','Commande payée']
    ]);
    $panier = $commandeRepository->findOneBy([
        'statut'=>'panier',
        'auteur'=>$this->getUser(),
    ]);

    return $this->render('cart/commandeIndex.html.twig',[
        'commandes' => $commandes,
        'panier' => $panier,
    ]);
    }
}
