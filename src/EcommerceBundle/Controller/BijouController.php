<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EcommerceBundle\Entity\Produit;
use EcommerceBundle\form\ProduitType;
use Symfony\Component\HttpFoundation\Request;

class BijouController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('EcommerceBundle:Produit')->findAll();

        $session = $request->getSession();
        $panier = $session->get('cartArray');

        return $this->render('EcommerceBundle:Default:bijoux.html.twig', array(
            'produits'=> $produits,
            'panieruser' => $panier,
        ));
    }
}