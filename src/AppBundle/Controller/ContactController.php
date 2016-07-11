<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ContactController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        return $this->render('AppBundle:Default:lucie&actu.html.twig', array(
            'paniers' => $panieruser,
        ));
    }
}