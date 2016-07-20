<?php

namespace EcommerceBundle\Controller;

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
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        $adresse1 = new Adresse();
        $form = $this->createForm('EcommerceBundle\Form\AdresseType', $adresse1);
        $adresse2 = new Adresse();
        $form = $this->createForm('EcommerceBundle\Form\AdresseType', $adresse2);
        $form->remove('adrIdcom');
        $form->handleRequest($request);
        $adresse1->setAdrType(1);

        if ($adresse1->getAdrType() != null) {
            if ($adresse1->getAdrType() == 1){
                $adresse1->setAdrType(2);
            }
            else {
                $adresse1->setAdrType(1);
            }
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sessionadresse = $session->get('adresseArray1');
            $session->set('adresseArray1', $adresse1);
//            $em->persist($adresse1);
//            $em->flush();

            return $this->redirectToRoute('adresse_show');
        }

        return $this->render('EcommerceBundle:adresse:new.html.twig', array(
            'adresse1' => $adresse1,
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
        $sessionadresse = $session->get('adresseArray');

        return $this->render('EcommerceBundle:adresse:show.html.twig', array(
            'paniers' => $panieruser,
            'sessionadr' => $sessionadresse,
        ));
    }

    /**
     * Displays a form to edit an existing Adresse entity.
     *
     */
    public function editAction(Request $request, Adresse $adresse)
    {
        $deleteForm = $this->createDeleteForm($adresse);
        $editForm = $this->createForm('EcommerceBundle\Form\AdresseType', $adresse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();

            return $this->redirectToRoute('adresse_edit', array('id' => $adresse->getId()));
        }

        return $this->render('EcommerceBundle:adresse:edit.html.twig', array(
            'adresse' => $adresse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
