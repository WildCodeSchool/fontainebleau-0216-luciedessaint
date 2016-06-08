<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BijouController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:bijoux.html.twig');
    }
}