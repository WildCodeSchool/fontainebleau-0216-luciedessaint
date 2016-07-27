<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TableauController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produit')->findAll();

        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        return $this->render('EcommerceBundle:Default:tableaux.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
            'produits' => $produits,
        ));
    }
}