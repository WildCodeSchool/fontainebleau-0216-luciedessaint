<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\AdresseModele;
use EcommerceBundle\Form\AdresseClientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Adresse controller.
 *
 */
class AdresseController extends Controller
{
    /**
     * Lists all Adresse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adresses = $em->getRepository('EcommerceBundle:AdresseModele')->findAll();

        return $this->render('EcommerceBundle:adresse:index.html.twig', array(
            'adresses' => $adresses,
        ));
    }

    /**
     * Creates a new Adresse entity.
     *
     */
    public function newAction(Request $request)
    {
        // recup de la session
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        $adresse_client = new AdresseModele();

        $adresse1 = new AdresseModele();
        $adresse1->setAdrTypeName('Facturation');
        $adresse_client->getAdresseModele()->add($adresse1);

        $adresse2 = new AdresseModele();
        $adresse2->setAdrTypeName('livraison');
        $adresse_client->getAdresseModele()->add($adresse2);

        $form = $this->createForm(AdresseClientType::class, $adresse_client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $session->get('adresseArray1');
            $session->get('adresseArray2');
            $session->set('adresseArray1', $adresse1);
            $session->set('adresseArray2', $adresse2);


            //var_dump($adresse_client); die;
            // si il y a une deuxieme adresse alors on persiste $adresse2 sinon $adresse 1 est l'adresse de livraison.
            if ($adresse2->getAdrAdr() != null)
            {
                $session->set('adresseArray2', $adresse2);
//                $em->persist($adresse2);
            }
            else {
                $adresse1->setAdrTypeName('livraison');
            }
//
//            $em->persist($adresse1);
//            $em->flush();


            return $this->redirectToRoute('ecommerce_adresse_show');
        }

        return $this->render('EcommerceBundle:adresse:new.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Adresse entity.
     *
     */
    public function showAction(Request $request)
    {
//        $deleteForm = $this->createDeleteForm($adresse);
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        // creation d'un form pour le submit new commande
        $commande = $this->createFormBuilder()->getForm();
        $commande->handleRequest($request);

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        $sessionadresse1 = $session->get('adresseArray1');
        $sessionadresse2 = $session->get('adresseArray2');


        return $this->render('EcommerceBundle:adresse:show.html.twig', array(
            'commande' => $commande->createView(),
            'paniers' => $panieruser,
            'langues' => $langues,
            'sessionadr1' => $sessionadresse1,
            'sessionadr2' => $sessionadresse2
        ));
    }

    /**
     * Displays a form to edit an existing Adresse entity.
     *
     */

    public function editAction(Request $request, AdresseModele $adresse)
    {
        $editForm = $this->createForm('EcommerceBundle\Form\AdresseModeleType', $adresse);
        $editForm->handleRequest($request);

        var_dump($adresse);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();

            //return $this->redirectToRoute('adresse_show', array('id' => $adresse->getId()));

            $commId = $adresse->getAdrIdcom()->getId();
            //var_dump($commId);exit;
            return $this->redirectToRoute('commande_show', array('id' => $commId));
        }

        return $this->render('EcommerceBundle:adresse:edit.html.twig', array(
            'adresse' => $adresse,
            'edit_form' => $editForm->createView(),
        ));
    }
            
    public function editsessionAction(Request $request)
    {

        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        $em = $this->getDoctrine()->getManager();

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        $session->get('adresseArray1')->setAdrTypeName('Facturation');

        $adresse_client = new AdresseModele();

        $adresse1 = new AdresseModele();
        $adresse1->setAdrTypeName('Facturation');
        $adresse_client->getAdresseModele()->add($adresse1);

        $adresse2 = new AdresseModele();
        $adresse2->setAdrTypeName('livraison');
        $adresse_client->getAdresseModele()->add($adresse2);

        $form = $this->createForm(AdresseClientType::class, $adresse_client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $session->get('adresseArray1');
            $session->get('adresseArray2');
            $session->set('adresseArray1', $adresse1);


            //var_dump($adresse_client); die;
            // si il y a une deuxieme adresse alors on persiste $adresse2 sinon $adresse 1 est l'adresse de livraison.
            if ($adresse2->getAdrAdr() != null)
            {
                $session->set('adresseArray2', $adresse2);
//               $em->persist($adresse2);
            }
            else {
                $adresse1->setAdrTypeName('livraison');
            }
//
//            $em->persist($adresse1);
//            $em->flush();


            return $this->redirectToRoute('ecommerce_adresse_show');
        }

        return $this->render('EcommerceBundle:Default:adresse.html.twig', array(
            'paniers' => $panieruser,
            'langues' => $langues,
            'form' => $form->createView(),
        ));
    }
}
