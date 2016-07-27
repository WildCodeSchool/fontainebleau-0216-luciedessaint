<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        
        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        return $this->render('AppBundle:Default:lucie&actu.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
        ));
    }
}