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
        $adresse = new Adresse();
        $form = $this->createForm('EcommerceBundle\Form\AdresseType', $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();

            return $this->redirectToRoute('adresse_show', array('id' => $adresse->getId()));
        }

        return $this->render('EcommerceBundle:adresse:new.html.twig', array(
            'adresse' => $adresse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Adresse entity.
     *
     */
    public function showAction(Adresse $adresse)
    {
        $deleteForm = $this->createDeleteForm($adresse);

        return $this->render('EcommerceBundle:adresse:show.html.twig', array(
            'adresse' => $adresse,
            'delete_form' => $deleteForm->createView(),
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
