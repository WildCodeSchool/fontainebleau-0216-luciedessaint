<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use EcommerceBundle\Entity\Newsletter;
use EcommerceBundle\Form\NewsletterType;

//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Newsletter controller.
 *
 */
class NewsletterController extends Controller
{
    /**
     * Lists all Newsletter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $newsletters = $em->getRepository('EcommerceBundle:Newsletter')->findAll();

        $iconePDF = "icone-PDF.ico";

        return $this->render('EcommerceBundle:newsletter:index.html.twig', array(
            'iconePDF' => $iconePDF,
            'newsletters' => $newsletters,
        ));
    }

    /**
     * Creates a new Newsletter entity.
     *
     */
    public function newAction(Request $request)
    {
        $newsletter = new Newsletter();
        $form = $this->createForm('EcommerceBundle\Form\NewsletterType', $newsletter);
        
        $form->remove('nwlMailDests');
        $form->remove('nwlEnvDate');
        $form->remove('nwlEnvoyee');
        
        $form->handleRequest($request);
        
        $newsletter->setNwlLocale("xx");
        $newsletter->setNwlEnvoyee(false);
        $newsletter->setNwlEnvDate(null);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Création effectuée'
            );

            //return $this->redirectToRoute('newsletter_show', array('id' => $newsletter->getId()));
            return $this->redirectToRoute('newsletter_index');

        }

        return $this->render('EcommerceBundle:newsletter:new.html.twig', array(
            'newsletter' => $newsletter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Newsletter entity.
     *
     */
    public function showAction(Newsletter $newsletter)
    {
        $deleteForm = $this->createDeleteForm($newsletter);
        
        $iconePDF = "icone-PDF.ico";
        
        $downloadfile = $newsletter->getNwlMailPj();
        //var_dump($downloadfile);

        return $this->render('EcommerceBundle:newsletter:show.html.twig', array(
            'iconePDF' => $iconePDF,
            'downloadfile' => $downloadfile,
            'newsletter' => $newsletter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Download de la newsletter coté Administration
     *
     */
    public function downloadAction($id)
    {

        //$this->generateUrl('blog_show', array('slug' => 'my-blog-post'), UrlGeneratorInterface::ABSOLUTE_URL);

        //$path = $this->get('kernel')->getRootDir(). "/../../../web/uploads/newsletters/";

        //$content = file_get_contents("/var/www/html/symfony/Ecommerce/web/uploads/newsletters/PJ_57a43b1c60b38.pdf");

        //$path = "/var/www/html/symfony/Ecommerce/web/uploads/newsletters/";
        //$path = "/../../../web/uploads/newsletters/";
        $path = __DIR__.'/../../../web/uploads/newsletters/';
        $filename = $id;
        
        $response = $this->container->get('download.pdf')->downloadPDF($path, $filename);

        return $response;

    }

    /**
     * Récupération de la liste des emails des abonnés actifs 
     * 
     *    Toutes langues (xx)  --ou--  Selon langue paramétrée dans la newsletter
     */
    public function recupDestinatairesAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $newsletter = $em->getRepository('EcommerceBundle:Newsletter')->find($id);
        $langue = $newsletter->getNwlLocale();
        
        if ($langue == "xx")
            $abonnements = $em->getRepository('EcommerceBundle:Abontnews')->findAbontnewsActifs();
        else 
            $abonnements = $em->getRepository('EcommerceBundle:Abontnews')->findAbontnewsActifs4Lang($langue);

        if (!$abonnements) {
            if ($langue == "xx") {
                $this->get('session')->getFlashBag()->add(
                    'mesModifs',
                    'ERREUR : Aucun abonnement actif'
                    );
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'mesModifs',
                    'ERREUR : Aucun abonnement actif pour cette langue'
                    );
            }
            return $this->redirectToRoute('newsletter_show', array('id' => $newsletter->getId()));
        }

        $destinataires = "";

        foreach ($abonnements as $idx_a => $abonnement) {
            $email = $abonnement->getAnlEmail();
            var_dump($email);

            if ($email) {
                if ($destinataires == "")
                    $destinataires = $email;
                else
                    $destinataires .= ", ".$email;
            }
        }

        $newsletter->setNwlMailDests($destinataires);
        
        $em->persist($newsletter);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Récupération emails effectuée'
        );

        return $this->redirectToRoute('newsletter_show', array('id' => $newsletter->getId()));

    }

    /**
     * Envoi de la newsletter
     *
     */
    public function envoiNewsletterAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $newsletter = $em->getRepository('EcommerceBundle:Newsletter')->find($id);

        $destinataires = $newsletter->getNwlMailDests();

        $dests = explode(", ", $destinataires);
        var_dump($dests);

        $objet = $newsletter->getNwlMailObjet();
        $texte = $newsletter->getNwlMailTexte();
        $PJ = $newsletter->getNwlMailPj();
        $lienDesabont = "Desabonnement";
        $texteDesabont = "<br/><br/>Pour vous désabonner; cliquez sur ce <a href='" . $lienDesabont . "'>lien</a>";
        $de = "luciedesaint@gmail.com";

        //
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        if ($PJ) {
            //
            //   Envoi de la newsletter avec pj
            //
            $message = \Swift_Message::newInstance()
                ->setSubject($objet)
                ->setFrom('q.dutrevis@gmail.com', 'Quentin')
                //->setTo("")
                //->setBcc($destinataires)
                //->setBcc(array([$dests]))
                ->setBcc($dests)
                ->setBody($texte . $texteDesabont, 'text/html')
/*              ->setBody(
                    $this->renderView('@Ecommerce/facture/confirmation.html.twig', array(
                        'texte' => $texte,
                        'texte2' => $texteDesabont,

                    )),
                    'text/html'
                )*/
                ->attach(\Swift_Attachment::fromPath('uploads/newsletters/' . $PJ));
            ;
            /*        $message->attach(
                        \Swift_Attachment::fromPath('/path/to/image.jpg')->setDisposition('inline')
                    );*/
        }
        else {
        //
        //   Envoi de la newsletter sans pj
        //

            $message = \Swift_Message::newInstance()
                ->setSubject($objet)
                ->setFrom('q.dutrevis@gmail.com', 'Quentin')
                //->setTo("")
                ->setBcc($dests)
                ->setBody($texte.$texteDesabont, 'text/html')
    /*            ->setBody(
                    $this->renderView('@Ecommerce/facture/confirmation.html.twig', array(
                        'texte' => $texte,
                        'texte2' => $texteDesabont,

                    )),
                    'text/html'
                )*/
            ;
        }
        //
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //

        $this->get('mailer')->send($message);

        //
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //   MAJ de la newsletter
        //

        $currentDte = new \DateTime();
        $newsletter->setNwlDateEnvoi($currentDte);
        $newsletter->setNwlEnvoyee(true);

        $em->persist($newsletter);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Envoi Newsletter effectué. Voir mail reçu avec liste des destinataires.'
        );

        return $this->redirectToRoute('newsletter_show', array('id' => $newsletter->getId()));

    }

    /**
     * Displays a form to edit an existing Newsletter entity.
     *
     */
    public function editAction(Request $request, Newsletter $newsletter)
    {
        $deleteForm = $this->createDeleteForm($newsletter);
        $editForm = $this->createForm('EcommerceBundle\Form\NewsletterType', $newsletter);

        $editForm->remove('nwlMailDests');
        $editForm->remove('nwlEnvDate');
        $editForm->remove('nwlEnvoyee');

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($editForm->get('maPJ')->getData() != null) {

                if($newsletter->getNwlMailPj() != null) {
                    unlink(__DIR__.'/../../../web/uploads/newsletters/'.$newsletter->getNwlMailPj());
                    $newsletter->setNwlMailPj(null);
                }
            }
            $newsletter->preUpload();

            $em->persist($newsletter);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'mesModifs',
                'Modification enregistrée'
            );

            //return $this->redirectToRoute('newsletter_edit', array('id' => $newsletter->getId()));
            return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('EcommerceBundle:newsletter:edit.html.twig', array(
            'newsletter' => $newsletter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Newsletter entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $newsletter = $em->getRepository('EcommerceBundle:Newsletter')->find($id);

        $em->remove($newsletter);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'mesModifs',
            'Suppression effectuée'
        );

        return $this->redirectToRoute('newsletter_index');
    }

    /**
     * Creates a form to delete a Newsletter entity.
     *
     * @param Newsletter $newsletter The Newsletter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Newsletter $newsletter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('newsletter_delete', array('id' => $newsletter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
