<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Abontnews;
use EcommerceBundle\Form\AbontnewsType;

/**
 * Abontnews controller.
 *
 */
class AbontnewsController extends Controller
{
    /**
     * Lists all Abontnews entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abontnews = $em->getRepository('EcommerceBundle:Abontnews')->findAll();

        return $this->render('EcommerceBundle:abontnews:index.html.twig', array(
            'abontnews' => $abontnews,
        ));
    }

    /**
     * Creates a new Abontnews entity.
     *
     */
    public function newAction(Request $request)
    {
        $abontnews = new Abontnews();

        $em = $this->getDoctrine()->getManager();
        $emailverif = $abontnews->getAnlEmail();

        var_dump($emailverif);

        //$res_verif = $em->getRepository('EcommerceBundle:Abontnews')->findEmail($emailverif);

        //var_dump($res_verif);


        /*if ($em->getRepository('EcommerceBundle:Abontnews')->findEmail($emailverif)){
            var_dump("erreur");
            exit;
        }*/

        $form = $this->createForm('EcommerceBundle\Form\AbontnewsType', $abontnews);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($abontnews);
            $em->flush();

            return $this->redirectToRoute('abontnews_show', array('id' => $abontnews->getId()));
        }

        return $this->render('EcommerceBundle:abontnews:new.html.twig', array(
            'abontnews' => $abontnews,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Abontnews entity.
     *
     */
    public function showAction(Abontnews $abontnews)
    {
        $deleteForm = $this->createDeleteForm($abontnews);

        return $this->render('EcommerceBundle:abontnews:show.html.twig', array(
            'abontnews' => $abontnews,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Abontnews entity.
     *
     */
    public function editAction(Request $request, Abontnews $abontnews)
    {
        $EtatEnBdd = $abontnews->getAnlEtat();

        $deleteForm = $this->createDeleteForm($abontnews);
        $editForm = $this->createForm('EcommerceBundle\Form\AbontnewsType', $abontnews);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //Initialisation variable avec CurrentDateTime
            $currentDte = new \DateTime();

            //var_dump($tva->getTvaEtat());exit;
            //var_dump($editForm->getViewData()->getAnlEtat());exit;
            //var_dump($editForm->getViewData()->getAnlDteDesact());exit;

            // Si Etat actuel (en bdd) => ACTIF et nouvel Etat (saisi par user) => INACTIF
            if ($EtatEnBdd == TRUE && $editForm->getViewData()->getAnlEtat() == FALSE) {
                // DateDesactivation passée à CurrentDateTime
                $abontnews->setAnlDteDesact($currentDte);
            }

            $em->persist($abontnews);
            $em->flush();

            return $this->redirectToRoute('abontnews_edit', array('id' => $abontnews->getId()));
        }

        return $this->render('EcommerceBundle:abontnews:edit.html.twig', array(
            'abontnews' => $abontnews,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Abontnews entity.
     *
     */
    public function deleteAction(Request $request, Abontnews $abontnews)
    {
        $form = $this->createDeleteForm($abontnews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($abontnews);
            $em->flush();
        }

        return $this->redirectToRoute('abontnews_index');
    }

    /**
     * Creates a form to delete a Abontnews entity.
     *
     * @param Abontnews $abontnews The Abontnews entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Abontnews $abontnews)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abontnews_delete', array('id' => $abontnews->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
