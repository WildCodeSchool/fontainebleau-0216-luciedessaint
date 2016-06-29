<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Tva;
use EcommerceBundle\Form\TvaType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Tva controller.
 *
 */
class TvaController extends Controller
{
    /**
     * Lists all Tva entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tvas = $em->getRepository('EcommerceBundle:Tva')->findAll();

        return $this->render('EcommerceBundle:tva:index.html.twig', array(
            'tvas' => $tvas,
        ));
    }

    /**
     * Creates a new Tva entity.
     *
     */
    public function newAction(Request $request)
    {
        $tva = new Tva();
        $form = $this->createForm('EcommerceBundle\Form\TvaType', $tva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tva);
            $em->flush();

            return $this->redirectToRoute('tva_show', array('id' => $tva->getId()));
        }

        return $this->render('EcommerceBundle:tva:new.html.twig', array(
            'tva' => $tva,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tva entity.
     *
     */
    public function showAction(Tva $tva)
    {
        $deleteForm = $this->createDeleteForm($tva);

        return $this->render('EcommerceBundle:tva:show.html.twig', array(
            'tva' => $tva,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tva entity.
     *
     */
    public function editAction(Request $request, Tva $tva)
    {
        //Sauvegarde Etat (actif/inactif), en BDD de l'enregistrement
        $EtatEnBdd = $tva->getTvaEtat();

        $deleteForm = $this->createDeleteForm($tva);
        $editForm = $this->createForm('EcommerceBundle\Form\TvaType', $tva);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //Initialisation variable avec CurrentDateTime
            $currentDte = new \DateTime();

            //var_dump($tva->getTvaEtat());exit;
            //var_dump($editForm->getViewData()->getTvaEtat());exit;
            //var_dump($editForm->getViewData()->getTvaDteDesact());exit;

            // Si Etat actuel (en bdd) => ACTIF et nouvel Etat (saisi par user) => INACTIF
            if ($EtatEnBdd == TRUE && $editForm->getViewData()->getTvaEtat() == FALSE) {
                // DateDesactivation passée à CurrentDateTime
                $tva->setTvaDteDesact($currentDte);
            }

            $em->persist($tva);
            $em->flush();

            return $this->redirectToRoute('tva_edit', array('id' => $tva->getId()));
        }

        return $this->render('EcommerceBundle:tva:edit.html.twig', array(
            'tva' => $tva,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tva entity.
     *
     */
    public function deleteAction(Request $request, Tva $tva)
    {
        $form = $this->createDeleteForm($tva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tva);
            $em->flush();
        }

        return $this->redirectToRoute('tva_index');
    }

    /**
     * Creates a form to delete a Tva entity.
     *
     * @param Tva $tva The Tva entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tva $tva)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tva_delete', array('id' => $tva->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
