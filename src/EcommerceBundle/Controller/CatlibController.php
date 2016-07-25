<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Catlib;
use EcommerceBundle\Form\CatlibType;

/**
 * Catlib controller.
 *
 */
class CatlibController extends Controller
{
    /**
     * Lists all Catlib entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $catlibs = $em->getRepository('EcommerceBundle:Catlib')->findAll();

        return $this->render('EcommerceBundle:catlib:index.html.twig', array(
            'catlibs' => $catlibs,
        ));
    }

    /**
     * Creates a new Catlib entity.
     *
     */
    public function newAction(Request $request)
    {
        $catlib = new Catlib();
        $form = $this->createForm('EcommerceBundle\Form\CatlibType', $catlib);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catlib);
            $em->flush();

            return $this->redirectToRoute('catlib_show', array('id' => $catlib->getId()));
        }

        return $this->render('EcommerceBundle:catlib:new.html.twig', array(
            'catlib' => $catlib,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Catlib entity.
     *
     */
    public function showAction(Catlib $catlib)
    {
        $deleteForm = $this->createDeleteForm($catlib);

        return $this->render('EcommerceBundle:catlib:show.html.twig', array(
            'catlib' => $catlib,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Catlib entity.
     *
     */
    public function editAction(Request $request, Catlib $catlib)
    {
        $deleteForm = $this->createDeleteForm($catlib);
        $editForm = $this->createForm('EcommerceBundle\Form\CatlibType', $catlib);
        $editForm->handleRequest($request);

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        $Code_lng = $catlib->getCtlLocale();

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération des infos 'langue'
        $em = $this->getDoctrine()->getManager();
        $lang = $em->getRepository('EcommerceBundle:Lang')->getLangByCode($Code_lng);
        //var_dump($lang);

        $langue = $lang[0];
        $catlib->langue = $langue;
        //var_dump($langue);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catlib);
            $em->flush();

            //return $this->redirectToRoute('catlib_edit', array('id' => $catlib->getId()));

            $catId = $catlib->getCtlIdcat()->getId();
            //var_dump($catId);exit;
            return $this->redirectToRoute('categorie_show', array('id' => $catId));
        }

        return $this->render('EcommerceBundle:catlib:edit.html.twig', array(
            'catlib' => $catlib,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Catlib entity.
     *
     */
    public function deleteAction(Request $request, Catlib $catlib)
    {
        $form = $this->createDeleteForm($catlib);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catlib);
            $em->flush();
        }

        return $this->redirectToRoute('catlib_index');
    }

    /**
     * Creates a form to delete a Catlib entity.
     *
     * @param Catlib $catlib The Catlib entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Catlib $catlib)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catlib_delete', array('id' => $catlib->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
