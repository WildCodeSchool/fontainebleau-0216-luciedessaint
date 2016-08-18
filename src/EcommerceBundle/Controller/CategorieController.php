<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Categorie;
use EcommerceBundle\Form\CategorieType;
use EcommerceBundle\Entity\Catlib;
use EcommerceBundle\Form\CatlibType;

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

        $categories = $em->getRepository('EcommerceBundle:Categorie')->getCategorieByLibAdmin();

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

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Création effectuée'
            );

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

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        $id = $categorie->getId();

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
            // Pour chaque langue gérée : Récupération du Catlib correspondant
            //
            foreach ($langs as $idx_l => $langue) {
                $idx_lang += 1;
                $langue->NroLang = $idx_lang;
                //var_dump($langue);
                //$langues[] = $langue->getlngCode();
                $CodeLang = $langue->getlngCode();
                $Catlib4Lang = $em->getRepository('EcommerceBundle:Catlib')->getCatlib4CategLang($id, $CodeLang);
                //var_dump($Catlib4Lang);

                if ($Catlib4Lang) {
                    $langue->LibCat = $Catlib4Lang[0];
                    //
                    // Si Catlib inexistant : Création
                    //
                } else {
//                    create a new object / persist the object / flush the entity manager

                    $catlib = new Catlib();
                    $catlib->setCtlLocale($CodeLang);
                    $catlib->setCtlIdcat($categorie);
                    //var_dump($catlib);
                    $em->persist($catlib);
                    $em->flush();
                    
                    $Catlib4Lang = $em->getRepository('EcommerceBundle:Catlib')->getCatlib4CategLang($id, $CodeLang);
                    $langue->LibCat = $Catlib4Lang[0];
                }
            }

            //var_dump($langs);
            $categorie->catlibs = $langs;

        }

        return $this->render('EcommerceBundle:categorie:show.html.twig', array(
            'categorie' => $categorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Suppression du bandeau associé à la catégorie
     */
    public function suppImgAction(Categorie $categorie)
    {

        $em = $this->getDoctrine()->getManager();

        $fichier = $categorie->getCatPhoto();
        $categorie->setCatPhoto(null);
        $categorie->preUpload();

        $em->persist($categorie);
        $em->flush();

        unlink(__DIR__.'/../../../web/uploads/categ/'.$fichier);

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Suppression bandeau associé effectuée'
        );

        return $this->redirectToRoute('categorie_show', array('id' => $categorie->getId()));

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

            if ($editForm->get('phCateg')->getData() != null) {
                if ($categorie->getCatPhoto() != null) {
                    unlink(__DIR__ . '/../../../web/uploads/categ/' . $categorie->getCatPhoto());
                    $categorie->setCatPhoto(null);
                }
            }
            $categorie->preUpload();

            $em->persist($categorie);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Modification enregistrée'
            );

            return $this->redirectToRoute('categorie_show', array('id' => $categorie->getId()));
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

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Suppression effectuée'
        );

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
            ->getForm();
    }
}


/*        if ($langs) {

            foreach ($langs as $idx_l => $langue ) {
                //var_dump($langue);
                $langues[] = $langue->getlngCode();
            }
            //$langues = ["fr", "es"];
            //var_dump($langues);

            /////////////////////////////////////////////////////////////////////////////////////////////
            //
            // Récupération de la liste des libellés 'localisés' pour une catégorie donnée ($id)

            $catlibs_4_categ = $em->getRepository('EcommerceBundle:Catlib')->getCatlib4CategInLang($id, $langues);
            //var_dump($catlibs_4_categ);
            //$categorie->catlibs = $catlibs_4_categ;

            foreach ($catlibs_4_categ as $idx_t => $catlibs ) {
                //var_dump($catlibs);
                $locale_catlib = $catlibs->getctlLocale();
                var_dump($locale_catlib);
                $key = array_search($locale_catlib, array_column($langs, 'lngCode'));
                var_dump($key);
                $catlibs->Locale = $langs[$key]->getlngLib();
                //$catlibs->Locale = $langs[$key]["lngLib"];
                $catlibs->Drapeau = $langs[$key]->getlngFlag();
                //$catlibs->Drapeau = $langs[$key]["lngFlag"];
                //var_dump($catlibs);

            }

            //var_dump($catlibs_4_categ);
            //$categorie->catlibs = $catlibs_4_categ;

            // Récupération du nbre de libellés 'localisés' pour une catégorie donnée ($id)
            //  => Count sur liste extraite précédemment
            //$nb_catlibs = count($catlibs_4_categ);
            //$categorie->nbcatlibs = $nb_catlibs;


            //
            /////////////////////////////////////////////////////////////////////////////////////////////
*/