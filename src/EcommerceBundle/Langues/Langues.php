<?php

namespace EcommerceBundle\Langues;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager as EntityManager;

class Langues
{
    /**
     * Récupération des langues actives
     * @param string $session
     * @return array $langues
     */

    private $em = null;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function RecupLangues($session)
    {
        //
        // s'il n'y a aucune session alors on en crée une
        //
        if ($session->getID() == null) {
            $session = new Session();
            $session->set('codeLang', 'fr');
        }

        //var_dump($session->get('codeLang'));
        $CodeLangActif = $session->get('codeLang');

        if ($CodeLangActif == null) {
            $session->set('codeLang', 'fr');
        }

        $CodeLangActif = $session->get('codeLang');
        $drapeauActif = "Flag_fr.png";
        $LangueActif = "Français";

        //var_dump($CodeLangActif);

        /////////////////////////////////////////////////////////////////////////////////////////////
        //
        // Récupération de la liste des langues gérées sur le site
        //
        $langs = $this->em->getRepository('EcommerceBundle:Lang')->findAll();

        //var_dump($langs);

        $nblangs = 0;

        if ($langs) {

            /////////////////////////////////////////////////////////////////////////////////////////////
            //
            $nblangs = count($langs);

            foreach ($langs as $idx_l => $langue) {
                //var_dump($langue);
                //$langues[] = $langue->getlngCode();
                $CodeLang = $langue->getlngCode();
                if ($CodeLang == $CodeLangActif) {
                    $drapeauActif = $langue->getlngFlag();
                    $LangueActif = $langue->getlngLib();
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////
        $langues = [
            'nblangs' => $nblangs,
            'lngCodeActif' => $CodeLangActif,
            'lngFlagActif' => $drapeauActif,
            'lngLibActif' => $LangueActif,
            'langs' => $langs,
            ];

        return $langues;

    }

}