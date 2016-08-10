<?php

namespace EcommerceBundle\Abonnement;

use EcommerceBundle\Entity\Abontnews;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager as EntityManager;

class Abonnement
{
    /**
     * Création d'un abonnement aux newsletters
     */

    private $em = null;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function CreatAbontnews($session, $email)
    {
        //
        // s'il n'y a aucune session alors on en crée une
        //
        if ($session->getID() == null) {
            $session = new Session();
            $session->set('codeLang', 'fr');
        }
        if ($session->get('codeLang') == null)
            $session->set('codeLang', 'fr');

        $CodeLangActif = $session->get('codeLang');

        $abontnews = $this->em->getRepository('EcommerceBundle:Abontnews')->findOneBy(array('anlEmail' => $email));

        // Si adresse mail déjà enregistrées => Maj en positionnant à l'état actif
        if ($abontnews) {

            $abontnews->setAnlEtat(true);
        }
        // Sinon création nouvel abonnement
        else {
            $abontnews = new Abontnews();
            $abontnews->setAnlLocale("fr");
            $abontnews->setAnlEmail($email);
            $abontnews->setAnlEtat(true);
            $abontnews->setAnlDteActif(new \DateTime());
            $abontnews->setAnlDteDesact(null);
        }

        $this->em->persist($abontnews);
        $this->em->flush();

        $response = [
            'Abontnews' => $abontnews,
        ];

        return $response;
    }

}