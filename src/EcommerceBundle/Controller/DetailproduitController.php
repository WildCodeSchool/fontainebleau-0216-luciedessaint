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
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);
        //var_dump($langues);

        $codelng = $langues["lngCodeActif"];
        //var_dump($codelng);

        $idprod = $produit->getId();
        //var_dump($idprod);

        $produit = $em->getRepository('EcommerceBundle:Prodlib')->getBijou4Lang($idprod, $codelng);

        if (!$produit)
            $produit = $em->getRepository('EcommerceBundle:Prodlib')->getBijou4Lang($idprod, "fr");

        $produit = $produit[0];
        //var_dump($produit);

        return $this->render('EcommerceBundle:Default:detailproduit.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
            'produit' => $produit,
        ));
    }
}