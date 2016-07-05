<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Categorie;
use EcommerceBundle\Form\CategorieType;

/**
 * Categorie controller.
 *
 */
class CategorieController extends Controller
{
    /**
     * Lists all Categorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();

        return $this->render('EcommerceBundle:categorie:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new Categorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm('EcommerceBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('categorie_show', array('id' => $categorie->getId()));
        }

        return $this->render('EcommerceBundle:categorie:new.html.twig', array(
            'categorie' => $categorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categorie entity.
     *
     */
    public function showAction(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($categorie);

        $id = $categorie->getId();

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération de la liste des libellés 'localisés' pour une catégorie donnée ($id)

        $catlibs_4_categ = $em->getRepository('EcommerceBundle:Catlib')->getCatlib4Categ($id);

        $categorie->catlibs = $catlibs_4_categ;

        // Récupération du nbre de libellés 'localisés' pour une catégorie donnée ($id)
        //  => Count sur liste extraite précédemment
        $nb_catlibs = count($catlibs_4_categ);

        $categorie->nbcatlibs = $nb_catlibs;

        var_dump($categorie);//exit;

        //
        /////////////////////////////////////////////////////////////////////////////////////////////

        return $this->render('EcommerceBundle:categorie:show.html.twig', array(
            'categorie' => $categorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categorie entity.
     *
     */
    public function editAction(Request $request, Categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);
        $editForm = $this->createForm('EcommerceBundle\Form\CategorieType', $categorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('categorie_edit', array('id' => $categorie->getId()));
        }

        return $this->render('EcommerceBundle:categorie:edit.html.twig', array(
            'categorie' => $categorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categorie entity.
     *
     */
    public function deleteAction(Request $request, Categorie $categorie)
    {
        $form = $this->createDeleteForm($categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }

    /**
     * Creates a form to delete a Categorie entity.
     *
     * @param Categorie $categorie The Categorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorie $categorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorie_delete', array('id' => $categorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
