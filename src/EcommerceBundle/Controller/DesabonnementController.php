<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Form\DesabonnementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Abontnews;
use EcommerceBundle\Form\AbontnewsType;


/**
 * Desabonnement controller.
 *
 */
class DesabonnementController extends Controller
{

    /**
     * Creates a new Desabonnement entity.
     *
     */
    public function newAction(Request $request)
    {
        // recup de la session
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        $form = $this->createForm('EcommerceBundle\Form\DesabonnementType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // Récupération enregt trouvé en bdd (si existe) correspondant à l'adresse mail saisie par user
            $email = $request->request->get('desabonnement')['Email'];
            var_dump($email);
            $abontnews = $em->getRepository('EcommerceBundle:Abontnews')->findOneBy(array('anlEmail' => $email));

            if (!$abontnews) {
                $this->get('session')->getFlashBag()->add(
                    'mesModifs',
                    'Adresse mail inconnue'
                );
                return $this->redirectToRoute('desabonnement');
            }

            // L'état et la date de déactivation sont positionnés automatiquement
            $abontnews->setAnlEtat(false);
            $abontnews->setAnlDteDesact(new \DateTime());
            
            $em->persist($abontnews);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Suppression effectuée'
            );

            return $this->redirectToRoute('desabonnement');
        }

        return $this->render('EcommerceBundle:Default:desabonnement.html.twig', array(
            'langues' => $langues,
            'paniers' => $panieruser,
            'form' => $form->createView(),
        ));
    }

}
