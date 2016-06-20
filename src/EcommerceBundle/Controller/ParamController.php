<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Param;
use EcommerceBundle\Form\ParamType;

/**
 * Param controller.
 *
 */
class ParamController extends Controller
{
    /**
     * Lists all Param entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $params = $em->getRepository('EcommerceBundle:Param')->findAll();

        return $this->render('EcommerceBundle:param:index.html.twig', array(
            'params' => $params,
        ));
    }

    /**
     * Creates a new Param entity.
     *
     */
    public function newAction(Request $request)
    {
        $param = new Param();
        $form = $this->createForm('EcommerceBundle\Form\ParamType', $param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($param);
            $em->flush();

            return $this->redirectToRoute('param_show', array('id' => $param->getId()));
        }

        return $this->render('EcommerceBundle:param:new.html.twig', array(
            'param' => $param,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Param entity.
     *
     */
    public function showAction(Param $param)
    {
        $deleteForm = $this->createDeleteForm($param);

        return $this->render('EcommerceBundle:param:show.html.twig', array(
            'param' => $param,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Param entity.
     *
     */
    public function editAction(Request $request, Param $param)
    {
        $deleteForm = $this->createDeleteForm($param);
        $editForm = $this->createForm('EcommerceBundle\Form\ParamType', $param);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($param);
            $em->flush();

            return $this->redirectToRoute('param_edit', array('id' => $param->getId()));
        }

        return $this->render('EcommerceBundle:param:edit.html.twig', array(
            'param' => $param,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Param entity.
     *
     */
    public function deleteAction(Request $request, Param $param)
    {
        $form = $this->createDeleteForm($param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($param);
            $em->flush();
        }

        return $this->redirectToRoute('param_index');
    }

    /**
     * Creates a form to delete a Param entity.
     *
     * @param Param $param The Param entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Param $param)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('param_delete', array('id' => $param->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
