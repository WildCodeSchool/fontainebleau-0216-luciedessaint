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

/*    public function download(Request $request, $id)
    {
        $session = $request->getSession();
        $session->set('triTableaux', $id);
        return $this->redirectToRoute('ecommerce_tableau');
    }*/
    public function downloadAction($id)
    {

        //$this->generateUrl('blog_show', array('slug' => 'my-blog-post'), UrlGeneratorInterface::ABSOLUTE_URL);

        // /var/www/html/symfony/Ecommerce/app/../../../web/uploads/newsletters/PJ_57a43b1c60b38.pdf
        // /var/www/html/symfony/Ecommerce/src/EcommerceBundle/Controller/../../../web/uploads/newsletters/PJ_57a43b1c60b38.pdf
        //$path =  __DIR__.'/../../../web/uploads/newsletters/';
        //$path = $this->get('kernel')->getRootDir(). "/../../../web/uploads/newsletters/";
        //$path =  '/../../../web/uploads/newsletters/';
        //$filename = $newsletter->getNwlMailPj();
        //$downloadfile = $path.$filename;

        //$path = $this->get('kernel')->getRootDir(). "/../../../web/uploads/newsletters/";
        //$content = file_get_contents($path.$id);

        //$content = file_get_contents("/var/www/html/symfony/Ecommerce/web/uploads/newsletters/PJ_57a43b1c60b38.pdf");

        //$path = "/var/www/html/symfony/Ecommerce/web/uploads/newsletters/";
        //$path = "/../../../web/uploads/newsletters/";
        $path = __DIR__.'/../../../web/uploads/newsletters/';
        $filename = $id;
        
        $response = $this->container->get('download.pdf')->downloadPDF($path, $filename);

        return $response;

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
