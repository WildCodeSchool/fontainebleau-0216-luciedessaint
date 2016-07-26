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
        $form = $this->createForm('EcommerceBundle\Form\LangType', $lang);
        $form->remove('lngCode');
        //$form->setData('lngCode', 'xx');
        //$form->remove('lngFlag');
        //$form->setData('lngFlag', 'xx');
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$LangType->setLngFlag($LangType->file->getClientOriginalName());

            //var_dump($form->getViewData()->getLngLib());exit;
            $langue = $form->getViewData()->getLngLib();

            switch ($langue) {
                case "Français":
                    $lang->setLngCode("fr"); break;
                case "English":
                    $lang->setLngCode("en"); break;
                case "Deutsch":
                    $lang->setLngCode("de"); break;
                case "Italiano":
                    $lang->setLngCode("it"); break;
                case "Español":
                    $lang->setLngCode("es"); break;
                case "Português":
                    $lang->setLngCode("pt"); break;
                case "中国":
                    $lang->setLngCode("zh"); break;
                case "ελληνικά":
                    $lang->setLngCode("el"); break;
                case "日本の":
                    $lang->setLngCode("ja"); break;
                case "한국의":
                    $lang->setLngCode("ko"); break;
                case "русский":
                    $lang->setLngCode("ru"); break;
                default:
                    exit;
            }

            $drapeau = "Flag_".$lang->getLngCode().".png";
            $lang->setLngFlag($drapeau);

            /*  "fr - Français" => "fr", "en - English" => "en", "de - Deutsch" => "de",
                "it - Italiano" => "it", "es - Español" => "es", "pt - Português" => "pt",
                "el - ελληνικά (Grec)" => "el", "ja - 日本の (Japonais)" => "ja",
                "zh - 中国 (Chinois)" => "zh", "ko - 한국의 (Coréen)" => "ko",
                "ru - русский (Russe)" => "ru"*/

            $em->persist($lang);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Création effectuée'
            );

            //return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
            return $this->redirectToRoute('lang_index');
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
        $editForm->remove('lngCode');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //var_dump($editForm->getViewData()->getLngLib());exit;
            $langue = $editForm->getViewData()->getLngLib();

            switch ($langue) {
                case "Français":
                    $lang->setLngCode("fr"); break;
                case "English":
                    $lang->setLngCode("en"); break;
                case "Deutsch":
                    $lang->setLngCode("de"); break;
                case "Italiano":
                    $lang->setLngCode("it"); break;
                case "Español":
                    $lang->setLngCode("es"); break;
                case "Português":
                    $lang->setLngCode("pt"); break;
                case "中国":
                    $lang->setLngCode("zh"); break;
                case "ελληνικά":
                    $lang->setLngCode("el"); break;
                case "日本の":
                    $lang->setLngCode("ja"); break;
                case "한국의":
                    $lang->setLngCode("ko"); break;
                case "русский":
                    $lang->setLngCode("ru"); break;
                default:
                    exit;
            }

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
