<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Prodlib;
use EcommerceBundle\Form\ProdlibType;

/**
 * Prodlib controller.
 *
 */
class ProdlibController extends Controller
{
    /**
     * Lists all Prodlib entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $prodlibs = $em->getRepository('EcommerceBundle:Prodlib')->findAll();

        return $this->render('EcommerceBundle:prodlib:index.html.twig', array(
            'prodlibs' => $prodlibs,
        ));
    }

    /**
     * Creates a new Prodlib entity.
     *
     */
    public function newAction(Request $request)
    {
        $prodlib = new Prodlib();
        $form = $this->createForm('EcommerceBundle\Form\ProdlibType', $prodlib);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prodlib);
            $em->flush();

            return $this->redirectToRoute('prodlib_show', array('id' => $prodlib->getId()));
        }

        return $this->render('EcommerceBundle:prodlib:new.html.twig', array(
            'prodlib' => $prodlib,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Prodlib entity.
     *
     */
    public function showAction(Prodlib $prodlib)
    {
        $deleteForm = $this->createDeleteForm($prodlib);

        return $this->render('EcommerceBundle:prodlib:show.html.twig', array(
            'prodlib' => $prodlib,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Prodlib entity.
     *
     */
    public function editAction(Request $request, Prodlib $prodlib)
    {
        $deleteForm = $this->createDeleteForm($prodlib);
        $editForm = $this->createForm('EcommerceBundle\Form\ProdlibType', $prodlib);
        $editForm->handleRequest($request);

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        $Code_lng = $prodlib->getPdlLocale();

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération des infos 'langue'
        $em = $this->getDoctrine()->getManager();
        $lang = $em->getRepository('EcommerceBundle:Lang')->getLangByCode($Code_lng);
        //var_dump($lang);

        $langue = $lang[0];
        $prodlib->langue = $langue;
        //var_dump($langue);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prodlib);
            $em->flush();

            //return $this->redirectToRoute('prodlib_edit', array('id' => $prodlib->getId()));

            $prodId = $prodlib->getPdlIdpdt()->getId();
            //var_dump($prodId);exit;
            return $this->redirectToRoute('produit_show', array('id' => $prodId));

        }

        return $this->render('EcommerceBundle:prodlib:edit.html.twig', array(
            'prodlib' => $prodlib,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Prodlib entity.
     *
     */
    public function deleteAction(Request $request, Prodlib $prodlib)
    {
        $form = $this->createDeleteForm($prodlib);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($prodlib);
            $em->flush();
        }

        return $this->redirectToRoute('prodlib_index');
    }

    /**
     * Creates a form to delete a Prodlib entity.
     *
     * @param Prodlib $prodlib The Prodlib entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Prodlib $prodlib)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prodlib_delete', array('id' => $prodlib->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
