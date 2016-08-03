<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class HomepageController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $panieruser = $session->get('cartArray');

        $langues = $this->container->get('recup.langues')->RecupLangues($session);

        $file_art = "";
        $file_kifa = "";
        $lucie = "";
        $dir = '../web/uploads/aleatoire'; # Directory containing images

        if (is_dir($dir)) {
            $arrImage_Art = glob($dir . "/Art_*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            //var_dump($arrImage_Art);

            if (count($arrImage_Art) > 0) {
                $alea_img_art = $arrImage_Art[array_rand($arrImage_Art)];
                //var_dump($alea_img_art);
                $file1 = explode("/", $alea_img_art);
                $file_art = array_pop($file1);
                //var_dump($file_art);
            }
            else
                var_dump("Aucune image ART dans le répertoire ".$dir);

            $arrImage_Kifa = glob($dir . "/Kifa_*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            //var_dump($arrImage_Kifa);

            if (count($arrImage_Kifa) > 0) {
                $alea_img_kifa = $arrImage_Kifa[array_rand($arrImage_Kifa)];
                //var_dump($alea_img_kifa);
                $filek1 = explode("/", $alea_img_kifa);
                $file_kifa = array_pop($filek1);
                //var_dump($file_kifa);
            }
            else
                var_dump("Aucune image KIFA dans le répertoire ".$dir);
        }
        else
            var_dump("Répertoire introuvable : ".$dir);


        return $this->render('AppBundle:Default:homepage.html.twig', array(
            'alea_art' => $file_art,
            'alea_kifa' => $file_kifa,
            'lucie' => $lucie,
            'langues' => $langues,
            'paniers' => $panieruser,
        ));
    }

    public function changtLangueAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session->set('codeLang', $id);
        var_dump($session->get('codeLang'));

        return $this->redirectToRoute('app_homepage');
    }
}
