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
            ->add('pdtPromoHt')
            ->add('pdtPromoTtc')
            ->add('pdtPhoto')
            ->add('pdtPhoto2')
            ->add('pdtPhoto3')
            ->add('pdtPhoto4')
            ->add('pdtPhoto5')
            ->add('pdtInfoVal1')
            ->add('pdtInfoVal2')
            ->add('pdtInfoVal3')
            ->add('pdtInfoVal4')
            ->add('pdtInfoVal5')
            ->add('pdtInfoVal6')
            ->add('pdtInfoVal7')
            ->add('pdtInfoVal8')
            ->add('pdtInfoVal9')
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
