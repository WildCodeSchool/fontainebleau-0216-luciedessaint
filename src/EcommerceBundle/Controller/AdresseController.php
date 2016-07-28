<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\AdresseClient;
use EcommerceBundle\Entity\AdresseModele;
use EcommerceBundle\Form\AdresseClientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Adresse;
use EcommerceBundle\Form\AdresseType;

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

        $adresses = $em->getRepository('EcommerceBundle:Adresse')->findAll();

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

        $adresse_client = new AdresseModele();

        $adresse1 = new AdresseModele();
        $adresse1->setAdrTypeName('Facturation');
        $adresse_client->getAdresseModele()->add($adresse1);

        $adresse2 = new AdresseModele();
        $adresse2->setAdrTypeName('livraison');
        $adresse_client->getAdresseModele()->add($adresse2);

        $form = $this->createForm(AdresseClientType::class, $adresse_client);

        $form->handleRequest($request);
        //adresse de livraison n'est pas définit. Et l'est si on click sur plusieur adresse (jquery)
        // il est définit que si il a plusieurs adresse.
        $adresse1->setAdrType(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sessionadresse = $session->get('adresseArray1');
            $sessionadresse = $session->get('adresseArray2');
            $session->set('adresseArray1', $adresse1);
            $session->set('adresseArray2', $adresse2);


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


            return $this->redirectToRoute('adresse_show');
        }

        return $this->render('EcommerceBundle:adresse:new.html.twig', array(
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

        $sessionadresse1 = $session->get('adresseArray1');
        $sessionadresse2 = $session->get('adresseArray2');

        $total=0;

        if ($panieruser != null) {
            foreach ($panieruser as $idx => $article) {
                $total += $article["prix"];
            }
        }

        return $this->render('EcommerceBundle:adresse:show.html.twig', array(
            'paniers' => $panieruser,
            'sessionadr1' => $sessionadresse1,
            'sessionadr2' => $sessionadresse2,
            'total' => $total
        ));
    }

    /**
     * Displays a form to edit an existing Adresse entity.
     *
     */
    public function editAction(Request $request)
    {

        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

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
        //adresse de livraison n'est pas définit. Et l'est si on click sur plusieur adresse (jquery)
        // il est définit que si il a plusieurs adresse.
        $adresse1->setAdrType(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sessionadresse = $session->get('adresseArray1');
            $sessionadresse = $session->get('adresseArray2');
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


            return $this->redirectToRoute('adresse_show');
        }

        return $this->render('EcommerceBundle:adresse:edit.html.twig', array(
            'paniers' => $panieruser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Adresse entity.
     *
     */
    public function deleteAction(Request $request, Adresse $adresse)
    {
        $form = $this->createDeleteForm($adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adresse);
            $em->flush();
        }

        return $this->redirectToRoute('adresse_index');
    }

    /**
     * Creates a form to delete a Adresse entity.
     *
     * @param Adresse $adresse The Adresse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adresse $adresse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adresse_delete', array('id' => $adresse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
