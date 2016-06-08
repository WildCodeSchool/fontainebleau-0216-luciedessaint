<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableauController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:tableaux.html.twig');
    }
}