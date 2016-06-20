<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParamlibType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prlLocale')
            ->add('prlDelaiLiv')
            ->add('prlLivRestrict')
            ->add('prlFabDelai')
            ->add('prlArtPhoto')
            ->add('prlArtPres')
            ->add('prlArtComm')
            ->add('prlPanTitre')
            ->add('prlPanPhoto')
            ->add('prlPanPres')
            ->add('prlPanComm')
            ->add('prlPanTabEnt')
            ->add('prlPanTabCol1')
            ->add('prlPanTabCol2')
            ->add('prlPanTabCol3')
            ->add('prlPanTabSupp')
            ->add('prlIdprm')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Paramlib'
        ));
    }
}
