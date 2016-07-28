<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class HomepageController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        return $this->render('AppBundle:Default:homepage.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
        ));
    }

    public function changtLangueAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session->set('codeLang', $id);
        var_dump($session->get('codeLang'));

        return $this->redirectToRoute('app_homepage');
    }
}
