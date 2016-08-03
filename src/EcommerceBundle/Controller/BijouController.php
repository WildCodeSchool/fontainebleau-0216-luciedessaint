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

        $session = $request->getSession();
        $panier = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);
        //var_dump($langues);

        $codelng = $langues["lngCodeActif"];
        //var_dump($codelng);

        //$produits = $em->getRepository('EcommerceBundle:Produit')->findAll();

        if ($session->get('triBijoux') == null)
            $session->set('triBijoux', 'cat');

        $tri = $session->get('triBijoux');

        if ($tri == "prix") {
            $catproduits = "";
            $produits = $em->getRepository('EcommerceBundle:Prodlib')->getBijouxAvendre4LangByPrix($codelng);
            if (!$produits)
                $produits = $em->getRepository('EcommerceBundle:Prodlib')->getBijouxAvendre4LangByPrix("fr");
            $libTri1 = "Catégorie (category)";
            $libTri2 = "cat";
        }
        else {
            $catproduits = $em->getRepository('EcommerceBundle:Prodlib')->getCatBijouxAvendre4LangByCat($codelng);
            $produits = $em->getRepository('EcommerceBundle:Prodlib')->getBijouxAvendre4LangByCat($codelng);

            if (!$produits) {
                $catproduits = $em->getRepository('EcommerceBundle:Prodlib')->getCatBijouxAvendre4LangByCat("fr");
                $produits = $em->getRepository('EcommerceBundle:Prodlib')->getBijouxAvendre4LangByCat("fr");
            }
            $libTri1 = "Prix (price)";
            $libTri2 = "prix";
        }
        //var_dump($catproduits);
        //var_dump($produits);

        $chariot = "shopping_cart.png";
        
        return $this->render('EcommerceBundle:Default:bijoux.html.twig', array(
            'tri' => $tri,
            'libTri1' => $libTri1,
            'libTri2' => $libTri2,
            'chariot' => $chariot,
            'langues' => $langues,
            'catproduits'=> $catproduits,
            'produits'=> $produits,
            'paniers' => $panier,
        ));
    }

    public function triBijouxAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session->set('triBijoux', $id);
        return $this->redirectToRoute('ecommerce_bijou');
    }

}