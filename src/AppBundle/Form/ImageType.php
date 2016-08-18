<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('imgTitre')
            ->add('phImage', 'file', array('label' => 'Photo', 'required' => false))
            //->add('imgCat')
            ->add("imgCat", "choice", array(
                "label" => "Catégorie :",
                "choices" => array(
                    "Art" => "Tableaux",
                    "Kifa" => "Bijoux"
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Image'
        ));
    }
}
