<?php

namespace BagueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BagueBundle:Default:home.html.twig');
    }
}
