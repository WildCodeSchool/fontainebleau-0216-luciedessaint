<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Commande;
use EcommerceBundle\Form\CommandeType;
use EcommerceBundle\Entity\AdresseModele;
use EcommerceBundle\Form\AdresseModeleType;
use EcommerceBundle\Entity\Compdt;

/**
 * Commande controller.
 *
 */
class CommandeController extends Controller
{
    /**
     * Lists all Commande entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('EcommerceBundle:Commande')->findAll();

        return $this->render('EcommerceBundle:commande:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }

    /**
     * Creates a new Commande entity.
     *
     */
    public function newAction(Request $request)
    {
        $commande = new Commande();
        $form = $this->createForm('EcommerceBundle\Form\CommandeType', $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_show', array('id' => $commande->getId()));
        }

        return $this->render('EcommerceBundle:commande:new.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commande entity.
     *
     */
    public function showAction(Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();

//        $deleteForm = $this->createDeleteForm($commande);

        $idcom = $commande->getId();

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération des adresses liées à la commande
        //
        $adresses = $em->getRepository('EcommerceBundle:AdresseModele')->getAdresses4Commande($idcom);

        $nbAdresses = count($adresses);
        //var_dump($adresses);

        $commande->nbAdresses = $nbAdresses;
        $commande->adresses = $adresses;
        //
        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération des produits liés à la commande
        //
        $produits = $em->getRepository('EcommerceBundle:Compdt')->getProdts4Commande($idcom);

        $nbProduits = count($produits);
        //var_dump($produits);

        $commande->nbProduits = $nbProduits;
        $commande->produits = $produits;
        //
        /////////////////////////////////////////////////////////////////////////////////////////////

        return $this->render('EcommerceBundle:commande:show.html.twig', array(
            'commande' => $commande,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commande entity.
     *
     */
    public function editAction(Request $request, Commande $commande)
    {
//        $deleteForm = $this->createDeleteForm($commande);
        $editForm = $this->createForm('EcommerceBundle\Form\CommandeType', $commande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_show', array('id' => $commande->getId()));
        }

        return $this->render('EcommerceBundle:commande:edit.html.twig', array(
            'commande' => $commande,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Commande entity.
     *
     */
/*    public function deleteAction(Request $request, Commande $commande)
    {
        $form = $this->createDeleteForm($commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commande);
            $em->flush();
        }

        return $this->redirectToRoute('commande_index');
    }*/

    /**
     * Creates a form to delete a Commande entity.
     *
     * @param Commande $commande The Commande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
/*    private function createDeleteForm(Commande $commande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commande_delete', array('id' => $commande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }*/
}
