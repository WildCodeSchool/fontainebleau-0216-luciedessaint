<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ActualiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:lucie&actu.html.twig');
    }
}