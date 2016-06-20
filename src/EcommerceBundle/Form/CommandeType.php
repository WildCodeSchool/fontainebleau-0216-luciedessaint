<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comCode')
            ->add('comEtat')
            ->add('comCdebank')
            ->add('comVenteDte', 'datetime')
            ->add('comExpedDte', 'datetime')
            ->add('comMajDte', 'datetime')
            ->add('comMajWho')
            ->add('comMajLib')
            ->add('comAnnulDte', 'datetime')
            ->add('comAnnulWho')
            ->add('comAnnulLib')
            ->add('comFact')
            ->add('comFactDte', 'datetime')
            ->add('comFactWho')
            ->add('comNbArts')
            ->add('comTvaUnique')
            ->add('comPrixTotHt')
            ->add('comPrixTotTtc')
            ->add('comEmbPoids')
            ->add('comEmbDim')
            ->add('comLivDelai')
            ->add('comComments')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Commande'
        ));
    }
}
