<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableauController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceBundle:Default:tableaux.html.twig');
    }
}