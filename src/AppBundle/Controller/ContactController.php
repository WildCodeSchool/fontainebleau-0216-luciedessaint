<?php

namespace AppBundle\Controller;

use Doctrine\DBAL\Types\StringType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ContactController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        
        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        $form = $this->createFormBuilder()
            ->add('mail', TextType::Class)
            ->add('sujet', TextType::Class)
            ->add('message', TextareaType::Class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('AppBundle:Default:contact.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
            'form' => $form->createView()
        ));
    }
}