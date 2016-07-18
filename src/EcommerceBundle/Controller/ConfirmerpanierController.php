<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EcommerceBundle\Entity\Adresse;
//use EcommerceBundle\Form\AdresseType;

class ConfirmerpanierController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        $total=0;
        $adresse = new Adresse();
        $form = $this->createForm('EcommerceBundle\Form\AdresseType', $adresse);
        $form->handleRequest($request);

        if ($panieruser != null) {
            foreach ($panieruser as $idx => $article) {
                $total += $article["prix"];
            }
        }

        return $this->render('EcommerceBundle:Default:confirmerpanier.html.twig', array(
            'paniers' => $panieruser,
            'total' => $total,
            'form' => $form->createView(),
        ));
    }
}