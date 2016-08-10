<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EcommerceBundle\Entity\Abontnews;
use EcommerceBundle\Form\AbontnewsType;


/**
 * Abonnement controller.
 *
 */
class GestAbonnementController extends Controller
{

    /**
     * Creates a new Abontnews entity.
     *
     */
    public function creatAbontAction(Request $request)
    {
        $email = $request->request->get('email');
        $maRoute = $request->request->get('route');
        $session = $request->getSession();

/*
        //$request = $this->getRequest();
        $referer = $request->headers->get('referer');
        //var_dump($referer);
        $baseUrl = $request->getBaseUrl();
        //var_dump($baseUrl);
        $lastPath = substr($referer, strpos($referer, $baseUrl) + strlen($baseUrl));
        //var_dump($lastPath);
        //$params = $request->headers->get('router');
        //var_dump($params);
        $params = $this->get('router')->getMatcher()->match($lastPath);
        var_dump($params);

        $maRoute = $params['_route'];
        //var_dump($maRoute);
*/

//        $reponse = "Email invalide";

        if ($email != null) {
            $abontnews = $this->container->get('abont.newsletters')->CreatAbontnews($session, $email);
//            $reponse = "Abonnement enregistré";

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Création effectuée'
            );
        }
        else {
            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Email invalide'
            );
        }

/*        return $this->redirect($this->generateUrl(
            $params['_route'],
            [
                'slug' => $params['slug']
            ]
        ));*/

        //return $this->redirectToRoute($params['_route']);
        return $this->redirectToRoute($maRoute);

//        return $reponse;
    }

    /**
     * Création(activation) Abonnement aux newsletters
     *  Appel au service dédié
     */
/*    public function abonnementAction(Request $request, $id)
    {
        $session = $request->getSession();

        $abontnews = $this->container->get('abont.newsletters')->CreatAbontnews($session, $id);

        return $abontnews;
    }*/

    /**
     * Création(activation) Abonnement aux newsletters
     *
     */
    /*    public function abonnementAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $abontnews = $em->getRepository('EcommerceBundle:Abontnews')->findOneBy(array('anlEmail' => $id));
    
            // Si adresse mail déjà enregistrées => Maj en positionnant à l'état actif
            if ($abontnews) {
                
                $abontnews->setAnlEtat(true);
            }
            // Sinon création nouvel abonnement
            else {
                $abontnews = new Abontnews();
                $abontnews->setAnlLocale("fr");
                $abontnews->setAnlEmail($id);
                $abontnews->setAnlEtat(true);
                $abontnews->setAnlDteActif(new \DateTime());
                $abontnews->setAnlDteDesact(null);
            }
    
            $em->persist($abontnews);
            $em->flush();
    
            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Création effectuée'
            );
            return $response;
        }*/

}
