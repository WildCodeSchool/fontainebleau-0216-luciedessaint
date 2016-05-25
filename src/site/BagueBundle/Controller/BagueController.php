<?php

namespace site\BagueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use site\BagueBundle\Entity\Bague;
use site\BagueBundle\Form\BagueType;

/**
 * Bague controller.
 *
 */
class BagueController extends Controller
{
    /**
     * Lists all Bague entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bagues = $em->getRepository('BagueBundle:Bague')->findAll();

        return $this->render('BagueBundle:bague:index.html.twig', array(
            'bagues' => $bagues,
        ));
    }

    /**
     * Creates a new Bague entity.
     *
     */
    public function newAction(Request $request)
    {
        $bague = new Bague();
        $form = $this->createForm('site\BagueBundle\Form\BagueType', $bague);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bague);
            $em->flush();

            return $this->redirectToRoute('bague_show', array('id' => $bague->getId()));
        }

        return $this->render('BagueBundle:bague:new.html.twig', array(
            'bague' => $bague,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bague entity.
     *
     */
    public function showAction(Bague $bague)
    {
        $deleteForm = $this->createDeleteForm($bague);

        return $this->render('BagueBundle:bague:show.html.twig', array(
            'bague' => $bague,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bague entity.
     *
     */
    public function editAction(Request $request, Bague $bague)
    {
        $deleteForm = $this->createDeleteForm($bague);
        $editForm = $this->createForm('site\BagueBundle\Form\BagueType', $bague);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bague);
            $em->flush();

            return $this->redirectToRoute('bague_edit', array('id' => $bague->getId()));
        }

        return $this->render('BagueBundle:bague:edit.html.twig', array(
            'bague' => $bague,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Bague entity.
     *
     */
    public function deleteAction(Request $request, Bague $bague)
    {
        $form = $this->createDeleteForm($bague);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bague);
            $em->flush();
        }

        return $this->redirectToRoute('bague_index');
    }

    /**
     * Creates a form to delete a Bague entity.
     *
     * @param Bague $bague The Bague entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bague $bague)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bague_delete', array('id' => $bague->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
