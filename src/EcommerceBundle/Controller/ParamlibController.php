<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Paramlib;
use EcommerceBundle\Form\ParamlibType;

/**
 * Paramlib controller.
 *
 */
class ParamlibController extends Controller
{
    /**
     * Lists all Paramlib entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paramlibs = $em->getRepository('EcommerceBundle:Paramlib')->findAll();

        return $this->render('EcommerceBundle:paramlib:index.html.twig', array(
            'paramlibs' => $paramlibs,
        ));
    }

    /**
     * Creates a new Paramlib entity.
     *
     */
    public function newAction(Request $request)
    {
        $paramlib = new Paramlib();
        $form = $this->createForm('EcommerceBundle\Form\ParamlibType', $paramlib);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paramlib);
            $em->flush();

            return $this->redirectToRoute('paramlib_show', array('id' => $paramlib->getId()));
        }

        return $this->render('EcommerceBundle:paramlib:new.html.twig', array(
            'paramlib' => $paramlib,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Paramlib entity.
     *
     */
    public function showAction(Paramlib $paramlib)
    {
        $deleteForm = $this->createDeleteForm($paramlib);

        return $this->render('EcommerceBundle:paramlib:show.html.twig', array(
            'paramlib' => $paramlib,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Paramlib entity.
     *
     */
    public function editAction(Request $request, Paramlib $paramlib)
    {
        $deleteForm = $this->createDeleteForm($paramlib);
        $editForm = $this->createForm('EcommerceBundle\Form\ParamlibType', $paramlib);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paramlib);
            $em->flush();

            return $this->redirectToRoute('paramlib_edit', array('id' => $paramlib->getId()));
        }

        return $this->render('EcommerceBundle:paramlib:edit.html.twig', array(
            'paramlib' => $paramlib,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Paramlib entity.
     *
     */
    public function deleteAction(Request $request, Paramlib $paramlib)
    {
        $form = $this->createDeleteForm($paramlib);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paramlib);
            $em->flush();
        }

        return $this->redirectToRoute('paramlib_index');
    }

    /**
     * Creates a form to delete a Paramlib entity.
     *
     * @param Paramlib $paramlib The Paramlib entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Paramlib $paramlib)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paramlib_delete', array('id' => $paramlib->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
