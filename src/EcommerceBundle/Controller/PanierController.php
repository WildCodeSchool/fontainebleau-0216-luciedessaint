<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class PanierController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $session->get('adresseArray1');
        $session->get('adresseArray2');

        $total=0;

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        if ($panieruser != null) {
            foreach ($panieruser as $idx => $article) {
                $total += $article["prix"];
            }
        }
        return $this->render('EcommerceBundle:Default:panier.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
            'total' => $total,
        ));
    }
    
    public function addPanierAction(Request $request, $id)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');
        $session->get('adresseArray1');
        $session->get('adresseArray2');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        // si il n'y a aucune session alors on en créé une
        if ($session->getID() == null) {
            $session = new Session();
        } else {

            // si il n'y pas de panier
            if (empty($session->get('cartArray')) == true) {

                $panieruser = [];
                $em = $this->getDoctrine()->getManager();

                //Recuperation de tout les champs du produit portant cette ID
                $produits = $em->getRepository('EcommerceBundle:Produit')->find($id);
                //var_dump($produits); die;

                //Recuperation de l'ID de la SESSION
                $user = $session->getId();
                //var_dump($panierUser); die;

                $panierUser[$id] = ['id' => $id, 'photo' => $produits->getPdtPhoto(), 'nom' => $produits->getPdtNom(), 'ref' => $produits->getPdtRef(), 'prix' => $produits->getPdtPrixUnitTtc()];
                $session->set('cartArray', $panierUser);
            }
            else{

                $em = $this->getDoctrine()->getManager();

                //Recuperation de tout les champs du produit portant cette ID
                $produits = $em->getRepository('EcommerceBundle:Produit')->find($id);

                $prod = ['id' => $id, 'photo' => $produits->getPdtPhoto(), 'nom' => $produits->getPdtNom(), 'ref' => $produits->getPdtRef(), 'prix' => $produits->getPdtPrixUnitTtc()];
                
                $panieruser[$id] = $prod;

                //ajout du nouveau produit dans CartArray de la session en cours
                $session->set('cartArray', $panieruser);
            }
            $total=0;

            if ($panieruser != null) {
                foreach ($panieruser as $idx => $article) {
                    $total += $article["prix"];
                }
            }

        }
        return $this->render('EcommerceBundle:Default:panier.html.twig', array(
            'langues' => $langues,
            'paniers' => $session->get('cartArray'),
            'total' => $total,
        ));
    }
    
    public function removePanierAction(Request $request, $id)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        //permet de retirer le produit du tableau
        unset($panieruser[$id]);
        // permet de faire la mise a jour du tableau
        $session->set('cartArray', $panieruser);


        return $this->redirectToRoute('ecommerce_panier', array(
            'paniers' => $panieruser,
        ));
    }
}