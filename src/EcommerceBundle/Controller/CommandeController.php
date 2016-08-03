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
        $session = $request->getSession();
        $panieruser = $session->get('panierArray');
        $nb=0;
        $prixttc=0;
        $prixht=0;

        $codebanque=1;

        if ($panieruser != null) {
            foreach ($panieruser as $idx => $article) {
                $nb++;
                $total += $article["prix"];
            }
        }

        $commande = new Commande();
        $form = $this->createForm('EcommerceBundle\Form\CommandeType', $commande);
        $form->remove('ComCode');
        $form->remove('ComEtat');
        $form->remove('ComCdebank');
        $form->remove('ComVenteDte');
        $form->remove('ComExpedDte');
        $form->remove('ComMajDte');
        $form->remove('ComMajWho');
        $form->remove('ComMajLib');
        $form->remove('ComAnnulDte');
        $form->remove('ComAnnulWho');
        $form->remove('ComAnnulLib');
        $form->remove('ComFact');
        $form->remove('ComFactDte');
        $form->remove('ComFactWho');
        $form->remove('ComNbArts');
        $form->remove('ComTvaUnique');
        $form->remove('ComPrixTotHt');
        $form->remove('ComPrixTotTtc');
        $form->remove('ComEmbPoids');
        $form->remove('ComEmbDim');
        $form->remove('ComLivDelai');
        $form->remove('ComComments');
        
        $form->handleRequest($request);

        if ($codebanque == 1) {
            $em = $this->getDoctrine()->getManager();

            $count = count($commandes = $em->getRepository('EcommerceBundle:Commande')->findAll());
            $count+=1;
            $time=new \DateTime();

            $commande->setComCode('C'.$count.$time->format('YmdHis').$count);
            $commande->setComEtat(1); // set
            $commande->setComCdebank($codebanque);
            $commande->setComVenteDte(new \DateTime()); // set
            $commande->setComExpedDte(null); // set
            $commande->setComMajDte(null); // set
            $commande->getComMajWho();
            $commande->getComMajLib();
            $commande->setComAnnulDte(null);
            $commande->getComAnnulWho();
            $commande->getComAnnulLib();
            $commande->getComFact(); //generer
            $commande->setComFactDte(new \DateTime());
            $commande->setComFactWho('Auto');
            $commande->setComNbArts($nb);
//            $commande->getComTvaUnique();
            $commande->getComPrixTotHt();
            $commande->getComPrixTotTtc();
//            $commande->getComEmbPoids();
//            $commande->getComEmbDim();
//            $commande->getComLivDelai();
//            $commande->getComComments();


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
        var_dump($adresses);

        $commande->nbadresses = $nbAdresses;
        $commande->adresses = $adresses;
        //
        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération des produits liés à la commande
        //
        $produits = $em->getRepository('EcommerceBundle:Compdt')->getProdts4Commande($idcom);

        $nbProduits = count($produits);
        var_dump($produits);

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
