<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use EcommerceBundle\Entity\Commande;
use EcommerceBundle\Form\CommandeType;
use EcommerceBundle\Entity\AdresseModele;
use EcommerceBundle\Entity\Produit;
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

        foreach ($commandes as $idx_c => $commande) {
            $etatcom = $commande->getComEtat();
            switch ($etatcom) {
                case 1:
                    $etatcomlib = "Confirmée"; break;
                case 2:
                    $etatcomlib = "En préparation"; break;
                case 3:
                    $etatcomlib = "Expédiée"; break;
                case 4:
                    $etatcomlib = "Reçue"; break;
                case 5:
                    $etatcomlib = "Close"; break;
                case 9:
                    $etatcomlib = "Annulée"; break;
                default:
                    $etatcomlib = "Saisie";
            }
            $commande->etatCom = $etatcomlib;
        }

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
        $panieruser = $session->get('cartArray');
        $infos = $session->get('cartInfos');

        $codebanque=2;

        $commande = new Commande();

        if ($codebanque == 2) {
            $em = $this->getDoctrine()->getManager();

            $count = count($commandes = $em->getRepository('EcommerceBundle:Commande')->findAll());
            $count+=1;
            $time=new \DateTime();

            $commande->setComCode('C'.$count.$time->format('YmdHis'));
            $commande->setComEtat(2); // set
            $commande->setComCdebank($codebanque);
            $commande->setComVenteDte($time); // set
            $commande->setComExpedDte(null); // set
            $commande->setComMajDte(null); // set
//            $commande->getComMajWho();
//            $commande->getComMajLib();
            $commande->setComAnnulDte(null);
//            $commande->getComAnnulWho();
//            $commande->getComAnnulLib();
            $commande->setComFact('F'.$count.$time->format('YmdHis')); //generer
            $commande->setComFactDte($time);
            $commande->setComFactWho('Auto');
            $commande->setComNbArts($infos[2]);
//            $commande->getComTvaUnique();
            $commande->setComPrixTotHt($infos[1]);
            $commande->setComPrixTotTtc($infos[0]);
//            $commande->getComEmbPoids();
//            $commande->getComEmbDim();
//            $commande->getComLivDelai();
//            $commande->getComComments();
            $em->persist($commande);
            $em->flush();

            // creation d'adresse
            $adresseArray1 = $session->get('adresseArray1');
            $adresseArray2 = $session->get('adresseArray2');

            $adresse_client = new AdresseModele();

            $adresse1 = new AdresseModele();
            $adresse1->setAdrTypeName($adresseArray1->getAdrTypeName());
            $adresse_client->getAdresseModele()->add($adresse1);

            $adresse1->setAdrNom($adresseArray1->getAdrNom());
            $adresse1->setAdrPrenom($adresseArray1->getAdrPrenom());
            $adresse1->setAdrSoc($adresseArray1->getAdrSoc());
            $adresse1->setAdrEmail($adresseArray1->getAdrEmail());
            $adresse1->setAdrTel($adresseArray1->getAdrTel());
            $adresse1->setAdrAdr($adresseArray1->getAdrAdr());
            $adresse1->setAdrCp($adresseArray1->getAdrCp());
            $adresse1->setAdrVille($adresseArray1->getAdrVille());
            $adresse1->setAdrIdcom($commande);

            if ($adresseArray1->getAdrTypeName() == "Facturation") {
                $adresse2 = new AdresseModele();
                $adresse2->setAdrTypeName('livraison');
                $adresse_client->getAdresseModele()->add($adresse2);

                $adresse2->setAdrNom($adresseArray2->getAdrNom());
                $adresse2->setAdrPrenom($adresseArray2->getAdrPrenom());
                $adresse2->setAdrSoc($adresseArray2->getAdrSoc());
                $adresse2->setAdrEmail($adresseArray2->getAdrEmail());
                $adresse2->setAdrTel($adresseArray2->getAdrTel());
                $adresse2->setAdrAdr($adresseArray2->getAdrAdr());
                $adresse2->setAdrCp($adresseArray2->getAdrCp());
                $adresse2->setAdrVille($adresseArray2->getAdrVille());

                $adresse2->setAdrIdcom($commande);

                $em->persist($adresse2);
            }
            $em->persist($adresse1);
            $em->flush();

            
            foreach ($panieruser as $key => $produit){
                $produit_commande = null;
                $compdt = new Compdt();
                $id_produit = $produit['id'];
                $produit_commande = $em->getRepository('EcommerceBundle:Produit')->findById($id_produit);
                $compdt->setCxpIdcom($commande);
                $compdt->setCxpIdpdt($produit_commande[0]);
                $compdt->setCxpNbpdt(1);
                $produit_commande[0]->setPdtEtat(false);
                $em->persist($compdt);
                $em->flush();
            }

            return $this->redirectToRoute('facture_show', array('id' => $commande->getId()));
        }

        return $this->render('EcommerceBundle:commande:new.html.twig', array(
            'commande' => $commande,
        ));
    }

    public function showFactureAction(Commande $id_commande)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Compdt')->findBy(array('cxpIdcom' => $id_commande));
        $commande = $em->getRepository('EcommerceBundle:Commande')->findOneBy(array('id' => $id_commande));
        $adresses = $em->getRepository('EcommerceBundle:AdresseModele')->findBy(array('adrIdcom' => $id_commande));

        /*return $this->render('@Ecommerce/facture/facture.html.twig', array(
            'produits' => $produits,
            'adresses' => $adresses,
            'commande' => $commande
        ));*/
        $html = $this->renderView('EcommerceBundle:facture:facture.html.twig', array(
            'produits' => $produits,
            'adresses' => $adresses,
            'commande' => $commande
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
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
        $etatcom = $commande->getComEtat();
        switch ($etatcom) {
            case 1:
                $etatcomlib = "Confirmée"; break;
            case 2:
                $etatcomlib = "En préparation"; break;
            case 3:
                $etatcomlib = "Expédiée"; break;
            case 4:
                $etatcomlib = "Reçue"; break;
            case 5:
                $etatcomlib = "Close"; break;
            case 9:
                $etatcomlib = "Annulée"; break;
            default:
                $etatcomlib = "Saisie";
        }
        $commande->etatCom = $etatcomlib;

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
        //Sauvegarde Etat en BDD de l'enregistrement
        $EtatEnBdd = $commande->getComEtat();
        switch ($EtatEnBdd) {
            case 1:
                $etatcomlib = "Confirmée"; break;
            case 2:
                $etatcomlib = "En préparation"; break;
            case 3:
                $etatcomlib = "Expédiée"; break;
            case 4:
                $etatcomlib = "Reçue"; break;
            case 5:
                $etatcomlib = "Close"; break;
            case 9:
                $etatcomlib = "Annulée"; break;
            default:
                $etatcomlib = "Saisie";
        }
        $commande->etatCom = $etatcomlib;

//        $deleteForm = $this->createDeleteForm($commande);
        $editForm = $this->createForm('EcommerceBundle\Form\CommandeType', $commande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //Initialisation variable avec CurrentDateTime
            $currentDte = new \DateTime();

            // Si majs
//            if ($YaUmaj == TRUE) {
                // DateMaj passée à CurrentDateTime + Auteur
                $commande->setComMajDte($currentDte);
                $commande->setComMajWho("Administrateur");
//            }

            // Si Annulation
            if ($EtatEnBdd != 9 && $editForm->getViewData()->getComEtat() == 9) {
                // DateAnnulation passée à CurrentDateTime + Auteur
                $commande->setComAnnulDte($currentDte);
                $commande->setComAnnulWho("Administrateur");
            }

            $em->persist($commande);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Modification enregistrée'
            );

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
