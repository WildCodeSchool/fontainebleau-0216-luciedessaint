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
        
        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        //var_dump($produits);
        
        return $this->render('EcommerceBundle:Default:bijoux.html.twig', array(
            'langues' => $langues,
            'produits'=> $produits,
            'paniers' => $panier,
        ));
    }
}