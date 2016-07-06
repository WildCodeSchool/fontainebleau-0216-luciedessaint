<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Lang;
use EcommerceBundle\Form\LangType;

/**
 * Lang controller.
 *
 */
class LangController extends Controller
{
    /**
     * Lists all Lang entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $langs = $em->getRepository('EcommerceBundle:Lang')->findAll();

        return $this->render('EcommerceBundle:lang:index.html.twig', array(
            'langs' => $langs,
        ));
    }

    /**
     * Creates a new Lang entity.
     *
     */
    public function newAction(Request $request)
    {
        $lang = new Lang();
        $request = $this->getRequest();
        $form    = $this->createForm(new LangType(), $lang);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$LangType->setLngFlag($LangType->file->getClientOriginalName());
            $em->persist($lang);
            $em->flush();

            return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
        }

        return $this->render('EcommerceBundle:lang:new.html.twig', array(
            'lang' => $lang,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Lang entity.
     *
     */
    public function showAction(Lang $lang)
    {
        $deleteForm = $this->createDeleteForm($lang);

        return $this->render('EcommerceBundle:lang:show.html.twig', array(
            'lang' => $lang,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lang entity.
     *
     */
    public function editAction(Request $request, Lang $lang)
    {
        $deleteForm = $this->createDeleteForm($lang);
        $editForm = $this->createForm('EcommerceBundle\Form\LangType', $lang);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($editForm->get('file')->getData() != null) {

                if($lang->getLngFlag() != null) {
                    unlink(__DIR__.'/../../../web/uploads/drapeaux/'.$lang->getLngFlag());
                    $lang->setLngFlag(null);
                }
            }

            $lang->preUpload();

            $em->persist($lang);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Modification enregistrée'
            );

            return $this->redirectToRoute('lang_index');
        }

        return $this->render('EcommerceBundle:lang:edit.html.twig', array(
            'lang' => $lang,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lang entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $lang = $em->getRepository('EcommerceBundle:Lang')->find($id);

        $em->remove($lang);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Suppression effectuée'
        );

        return $this->redirectToRoute('lang_index');
    }

    /**
     * Creates a form to delete a Lang entity.
     *
     * @param Lang $lang The Lang entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lang $lang)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lang_delete', array('id' => $lang->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
