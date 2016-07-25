<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TableauController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        return $this->render('EcommerceBundle:Default:tableaux.html.twig', array(
            'paniers' => $panieruser,
        ));
    }
}