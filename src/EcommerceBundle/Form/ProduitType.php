<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pdtEtat')
            ->add('pdtAvendre')
//            ->add('pdtAffNostock')
            ->add('pdtAffPrix')
            ->add('pdtNom')
            ->add('pdtRef')
            ->add('pdtPrixUnitHt')
            ->add('pdtPrixUnitTtc')
            ->add('pdtPromoPct')
            ->add('phProdt', 'file', array('label' => 'Photo du produit', 'required' => false))
//            ->add('phProdt2', 'file', array('label' => 'Photo produit 2', 'required' => false))
            ->add('pdtPoids')
            ->add('pdtDim')
            ->add('pdtEmbPoids')
            ->add('pdtEmbDim')
            ->add('phPackag', 'file', array('label' => 'Photo du packaging', 'required' => false))
            ->add('pdtIdtva')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Produit'
        ));
    }
}
