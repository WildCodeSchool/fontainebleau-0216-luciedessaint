<?php

namespace EcommerceBundle\Downloads;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Pdf
{
    /**
     * Service de téléchargement de fichier
     * @param string $filename
     * @return array $reponse
     */

    public function downloadPDF($path, $filename)
    {
        //
        // Vérification existence fichier
        //

        if ($filename != null && $path != null) {

            $content = file_get_contents($path.$filename);

            $response = new Response();

//          set headers
            $response->headers->set('Content-Type', 'mime/type');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

            $response->setContent($content);
            return $response;

        }
    }
}
