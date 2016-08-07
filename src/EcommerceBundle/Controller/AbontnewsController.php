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

        //$abontnews = $em->getRepository('EcommerceBundle:Abontnews')->findAll();

        $abontnewsActifs = $em->getRepository('EcommerceBundle:Abontnews')->findAbontnewsActifs();
        $abontnewsInactifs = $em->getRepository('EcommerceBundle:Abontnews')->findAbontnewsInactifs();

        $nbEtats = -1;
        
        if ($abontnewsActifs) {
            $nbEtats++;
            //$abontnews[$nbEtats]->Etat = "actif";
            //$abontnews[$nbEtats]->Abonnements = $abontnewsActifs;
            $abontnews[$nbEtats]["Etat"] = "actif";
            $abontnews[$nbEtats]["Abonnements"] = $abontnewsActifs;
        }
        
        if ($abontnewsInactifs) {
            $nbEtats++;
            //$abontnews[$nbEtats]->Etat = "inactif";
            //$abontnews[$nbEtats]->Abonnements = $abontnewsInactifs;
            $abontnews[$nbEtats]["Etat"] = "inactif";
            $abontnews[$nbEtats]["Abonnements"] = $abontnewsInactifs;
        }

        //var_dump($abontnews);
        
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
        
        $form = $this->createForm('EcommerceBundle\Form\AbontnewsType', $abontnews);
        $form->remove('anlEtat');
        $form->handleRequest($request);

        $abontnews->setAnlLocale("fr");

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            // Récupération enregt trouvé en bdd (si existe) correspondant à l'adresse mail tapée par user
            $mail = $em->getRepository('EcommerceBundle:Abontnews')->findOneBy(array('anlEmail' => $form->getViewData()->getAnlEmail()));

//            if ($mail){
//                $request->getSession()
//                    ->getFlashbag()
//                    ->add('fail', 'blaireau')
//                ;
//                return $this->render('EcommerceBundle:abontnews:index.html.twig', array(
//                    'abontnews' => $newsletter,
//                ));
//            }

//            $em = $this->getDoctrine()->getManager();
//            $res_verif = $em->getRepository('EcommerceBundle:Abontnews')->findEmail($form->getViewData()->getAnlEmail());
//            var_dump($res_verif);
//            if ($res_verif) {
//                  return $this->redirectToRoute('abontnews_edit', array('id' => $res_verif[0]->getId()));
//            }

            // Si email déjà existant => Renvoi vers vue de l'enregt concerné en 'edit'
            if ($mail) {
                    return $this->redirectToRoute('abontnews_edit', array('id' => $mail->getId()));
            }

            // L'état et la date d'activation sont positionnés automatiquement
            $abontnews->setAnlEtat(true);
            $abontnews->setAnlDteActif(new \DateTime());
            $abontnews->setAnlDteDesact(null);

            $em->persist($abontnews);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Création effectuée'
            );

            //return $this->redirectToRoute('abontnews_show', array('id' => $abontnews->getId()));
            return $this->redirectToRoute('abontnews_index');

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

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Modification effectuée'
            );

            //return $this->redirectToRoute('abontnews_edit', array('id' => $abontnews->getId()));
            return $this->redirectToRoute('abontnews_index');

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
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $abontnews = $em->getRepository('EcommerceBundle:Abontnews')->find($id);

        $em->remove($abontnews);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Suppression effectuée'
        );

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
