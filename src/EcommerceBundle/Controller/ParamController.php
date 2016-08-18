<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Paramlib;
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
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $param = $em->getRepository('EcommerceBundle:Param')->findAll();

        if (!$param) {
            $param = new Param();
            $param->setPrmNbnivcat(2);
            $param->setPrmDevise("€");
            $param->setPrmTvaUnique(false);
            $param->setPrmNewsletter(false);
            $param->setPrmFactGen(false);
            $param->setPrmFactEnv(false);
            $param->setPrmFactUpload(false);
            $param->setPrmIdtva(null);
            //var_dump($param);
            $em->persist($param);
            $em->flush();

            $param = $em->getRepository('EcommerceBundle:Param')->findAll();
        }

        $id = -1;

        foreach ($param as $idx_p => $first) {
            if ($id == -1) {
                $id = $first->getId();
                $param = $em->getRepository('EcommerceBundle:Param')->find($id);
            }
        }

        $id = $param->getId();
        
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
            // Pour chaque langue gérée : Récupération du Paramlib correspondant
            //
            foreach ($langs as $idx_l => $langue) {
                $idx_lang += 1;
                $langue->NroLang = $idx_lang;
                //var_dump($langue);
                //$langues[] = $langue->getlngCode();
                $CodeLang = $langue->getlngCode();
                $Paramlib4Lang = $em->getRepository('EcommerceBundle:Paramlib')->getParamlib4ParamLang($id, $CodeLang);
                //var_dump($Paramlib4Lang);

                if ($Paramlib4Lang) {
                    $langue->LibParam = $Paramlib4Lang[0];
                    //
                    // Si Paramlib inexistant : Création
                    //
                } else {
//                    create a new object / persist the object / flush the entity manager

                    $paramlib = new Paramlib();
                    $paramlib->setPrlLocale($CodeLang);
                    $paramlib->setPrlIdprm($param);
                    //var_dump($paramlib);
                    $em->persist($paramlib);
                    $em->flush();

                    $Paramlib4Lang = $em->getRepository('EcommerceBundle:Paramlib')->getParamlib4ParamLang($id, $CodeLang);
                    $langue->LibParam = $Paramlib4Lang[0];
                }
            }

            //var_dump($langs);
            $param->paramlibs = $langs;

        }

        return $this->render('EcommerceBundle:param:show.html.twig', array(
            'param' => $param,
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

            return $this->redirectToRoute('param_show', array('id' => $param->getId()));
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
