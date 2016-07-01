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
            ->add('pdtAffNostock')
            ->add('pdtAffPrix')
            ->add('pdtNom')
            ->add('pdtRef')
            ->add('pdtPrixUnitHt')
            ->add('pdtPrixUnitTtc')
            ->add('pdtPromoPct')
            ->add('pdtPhoto')
            ->add('pdtPoids')
            ->add('pdtDim')
            ->add('pdtEmbPoids')
            ->add('pdtEmbDim')
            ->add('pdtPckgPhoto')
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
