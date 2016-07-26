<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use EcommerceBundle\Entity\Produit;
use EcommerceBundle\Form\ProduitType;

class DetailproduitController extends Controller
{
    public function indexAction(Request $request, Produit $produit)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        
        
        return $this->render('EcommerceBundle:Default:detailproduit.html.twig', array(
            'paniers' => $panieruser,
            'produit' => $produit,
        ));
    }
}