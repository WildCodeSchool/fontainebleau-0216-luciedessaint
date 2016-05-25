<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bagues = $em->getRepository('BagueBundle:Bague')->findAll();

        return $this->render('EcommerceBundle:Default:index.html.twig', array(
            'bagues' => $bagues,
        ));
    }
}
