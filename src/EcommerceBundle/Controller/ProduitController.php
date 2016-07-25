<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Prodlib;
use EcommerceBundle\Entity\Catlib;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Produit;
use EcommerceBundle\Form\ProduitType;

/**
 * Produit controller.
 *
 */
class ProduitController extends Controller
{
    /**
     * Lists all Produit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('EcommerceBundle:Produit')->findAll();

        return $this->render('EcommerceBundle:produit:index.html.twig', array(
            'produits' => $produits,
        ));
    }

    /**
     * Creates a new Produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('EcommerceBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();

//        $session = $request->getSession();
//        $session->set('nom', $produit->getPdtNom());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produit_show', array('id' => $produit->getId()));
        }

        return $this->render('EcommerceBundle:produit:new.html.twig', array(
            'categories' => $categories,
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produit entity.
     *
     */
    public function showAction(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($produit);

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        $id = $produit->getId();

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération de la liste des codes 'langue' gérés sur le site
        //
        $langs = $em->getRepository('EcommerceBundle:Lang')->findAll();

        //var_dump($langs);

        if ($langs) {

            $idx_lang = 0;
            /////////////////////////////////////////////////////////////////////////////////////////////
            //
            // Pour chaque langue gérée : Récupération du Prodlib correspondant
            //
            foreach ($langs as $idx_l => $langue) {
                $idx_lang += 1;
                $langue->NroLang = $idx_lang;
                //var_dump($langue);
                //$langues[] = $langue->getlngCode();
                $CodeLang = $langue->getlngCode();
                $Prodlib4Lang = $em->getRepository('EcommerceBundle:Prodlib')->getProdlib4ProdLang($id, $CodeLang);
                //var_dump($Prodlib4Lang);

                if ($Prodlib4Lang) {
                    $langue->LibProd = $Prodlib4Lang[0];
                    //
                    // Si Prodlib inexistant : Création
                    //
                } else {
//                    create a new object / persist the object / flush the entity manager
                    
                    $id_cat = $produit->getPdtIdcat();
                    var_dump($id_cat);

                    $Catlib4Lang = $em->getRepository('EcommerceBundle:Catlib')->getCatlib4CategLang($id_cat, $CodeLang);
                    //var_dump($Catlib4Lang);
                    //var_dump($Catlib4Lang[0]->getCtlCateg());

                    $prodlib = new Prodlib();
                    $prodlib->setPdlLocale($CodeLang);
                    $prodlib->setPdlIdpdt($produit);
                    
                    $prodlib->setPdlCat($Catlib4Lang[0]->getCtlCateg());
                    $prodlib->setPdlType($Catlib4Lang[0]->getCtlType());
                    $prodlib->setPdlItem($Catlib4Lang[0]->getCtlItem());

                    $prodlib->setPdlLib($Catlib4Lang[0]->getCtlLib());

                    $prodlib->setPdlInfoLib1($Catlib4Lang[0]->getCtlInfoLib1());
                    $prodlib->setPdlInfoLib2($Catlib4Lang[0]->getCtlInfoLib2());
                    $prodlib->setPdlInfoLib3($Catlib4Lang[0]->getCtlInfoLib3());
                    $prodlib->setPdlInfoLib4($Catlib4Lang[0]->getCtlInfoLib4());
                    $prodlib->setPdlInfoLib5($Catlib4Lang[0]->getCtlInfoLib5());
                    $prodlib->setPdlInfoLib6($Catlib4Lang[0]->getCtlInfoLib6());
                    $prodlib->setPdlInfoLib7($Catlib4Lang[0]->getCtlInfoLib7());
                    $prodlib->setPdlInfoLib8($Catlib4Lang[0]->getCtlInfoLib8());
                    $prodlib->setPdlInfoLib9($Catlib4Lang[0]->getCtlInfoLib9());

                    //var_dump($prodlib);
                    $em->persist($prodlib);
                    $em->flush();

                    $Prodlib4Lang = $em->getRepository('EcommerceBundle:Prodlib')->getProdlib4ProdLang($id, $CodeLang);
                    $langue->LibProd = $Prodlib4Lang[0];
                }
            }

            //var_dump($langs);
            $produit->prodlibs = $langs;

        }

        return $this->render('EcommerceBundle:produit:show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produit entity.
     *
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('EcommerceBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        // ceci permet d'enlever la colonne pdtRef dans l'editform
        //$editForm->remove('pdtRef');

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($editForm->get('phProdt')->getData() != null) {
                if($produit->getPdtPhoto() != null) {
                    unlink(__DIR__.'/../../../web/uploads/produits/'.$produit->getPdtPhoto());
                    $produit->setPdtPhoto(null);
                }
            }
/*            if($editForm->get('phProdt2')->getData() != null) {
                if($produit->getPdtPhoto2() != null) {
                    unlink(__DIR__.'/../../../web/uploads/produits/'.$produit->getPdtPhoto2());
                    $produit->setPdtPhoto2(null);
                }
            }*/
            if($editForm->get('phPackag')->getData() != null) {
                if($produit->getPdtPckgPhoto() != null) {
                    unlink(__DIR__.'/../../../web/uploads/produits/'.$produit->getPdtPckgPhoto());
                    $produit->setPdtPckgPhoto(null);
                }
            }
            $produit->preUpload();

            $em->persist($produit);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Modification enregistrée'
            );

            return $this->redirectToRoute('produit_show', array('id' => $produit->getId()));
//            return $this->redirectToRoute('produit_index');
        }

        return $this->render('EcommerceBundle:produit:edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Produit entity.
     *
     */
    public function deleteAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit_index');
    }

    /**
     * Creates a form to delete a Produit entity.
     *
     * @param Produit $produit The Produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
