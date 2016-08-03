<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TableauController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);
        //var_dump($langues);

        $codelng = $langues["lngCodeActif"];
        //var_dump($codelng);

        //$produits = $em->getRepository('EcommerceBundle:Produit')->findAll();

        if ($session->get('triTableaux') == null)
            $session->set('triTableaux', 'cat');

        $tri = $session->get('triTableaux');

        if ($tri == "prix") {
            $catproduits = "";
            $produits = $em->getRepository('EcommerceBundle:Prodlib')->getTableaux4LangByPrix($codelng);
            if (!$produits)
                $produits = $em->getRepository('EcommerceBundle:Prodlib')->getTableaux4LangByPrix("fr");
            $libTri1 = "Catégorie (category)";
            $libTri2 = "cat";
        }
        else {
            $catproduits = $em->getRepository('EcommerceBundle:Prodlib')->getCatTableaux4LangByCat($codelng);
            $produits = $em->getRepository('EcommerceBundle:Prodlib')->getTableaux4LangByCat($codelng);

            if (!$produits) {
                $catproduits = $em->getRepository('EcommerceBundle:Prodlib')->getCatTableaux4LangByCat("fr");
                $produits = $em->getRepository('EcommerceBundle:Prodlib')->getTableaux4LangByCat("fr");
            }
            $libTri1 = "Prix (price)";
            $libTri2 = "prix";
        }
        //var_dump($catproduits);
        //var_dump($produits);

        return $this->render('EcommerceBundle:Default:tableaux.html.twig', array(
            'langues' => $langues,
            'tri' => $tri,
            'libTri1' => $libTri1,
            'libTri2' => $libTri2,
            'catproduits'=> $catproduits,
            'paniers' => $panieruser,
            'produits' => $produits,
        ));
    }

    public function triTableauxAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session->set('triTableaux', $id);
        return $this->redirectToRoute('ecommerce_tableau');
    }
}