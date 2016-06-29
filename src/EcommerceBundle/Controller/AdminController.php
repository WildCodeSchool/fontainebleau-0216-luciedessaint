<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abontnews = $em->getRepository('EcommerceBundle:Abontnews')->findAll();
        $commandes = $em->getRepository('EcommerceBundle:Commande')->findAll();
        $produits = $em->getRepository('EcommerceBundle:Produit')->findAll();
        $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();
        $tvas = $em->getRepository('EcommerceBundle:Tva')->findAll();
        $langs = $em->getRepository('EcommerceBundle:Lang')->findAll();
        $params = $em->getRepository('EcommerceBundle:Param')->findAll();

        return $this->render('EcommerceBundle:admin:index.html.twig', array(
            'abontnews' => $abontnews,
            'commandes' => $commandes,
            'produits' => $produits,
            'categories' => $categories,
            'tvas' => $tvas,
            'langs' => $langs,
            'params' => $params,
        ));
    }
}