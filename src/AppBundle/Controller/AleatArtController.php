<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AleatArtController extends Controller
{
    public function indexAction(Request $request)
    {
        $nbimages = 0;
        $dir = '../web/uploads/aleatoire/art'; # Directory containing images
//       Check if directory exists
        if (is_dir($dir)) {
            # Get all PNG images. Concatenate path.
            //$arrImage = glob($dir . '/*.png');
            //$arrImage = array();
            $arrImage = glob($dir . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            var_dump($arrImage);
            $nbimages = count($arrImage);

            # Any images found?
            if (count($arrImage) > 0) {
                var_dump(count($arrImage)." image(s) dans le répertoire " . $dir);
                foreach ($arrImage as $idx_i => $image) {
                    $file1 = explode("/", $image);
                    $image = array_pop($file1);
                }
            } else
                var_dump("Aucune image dans le répertoire " . $dir);
        } else
            var_dump("Répertoire introuvable : " . $dir);


        return $this->render('AppBundle:Default:aleatart.html.twig', array(
            'nbimages' => $nbimages,
            'images' => $arrImage,
        ));
    }

    /**
     * Deletes an image.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if (null !== $id) {
            $dir = '../web/uploads/aleatoire/art/';
            $file = $dir.$id;
            var_dump($file);
            if ($file) {
                unlink($file);
            }
        }

        return $this->redirectToRoute('app_aleatart');
    }

    public function preUpload()
    {
        if (null !== $this->phProdt) {
            // do whatever you want to generate a unique name
            $this->pdtPhoto = 'Pdt_'.uniqid().'.'.$this->phProdt->guessExtension();
        }

        /*        if (null !== $this->phProdt2) {
                    $this->pdtPhoto2 = 'Pdt2_'.uniqid().'.'.$this->phProdt2->guessExtension();
                }*/

        if (null !== $this->phPackag) {
            $this->pdtPckgPhoto = 'Pckg_'.uniqid().'.'.$this->phPackag->guessExtension();
        }
    }

}