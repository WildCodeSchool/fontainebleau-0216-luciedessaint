<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BijouController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceBundle:Default:bijoux.html.twig');
    }
}