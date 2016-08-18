<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prmNbnivcat')
            ->add('prmDevise')
//            ->add('prmTvaUnique')
//            ->add('prmNewsletter')
//            ->add('prmFactGen')
//            ->add('prmFactEnv')
//            ->add('prmFactUpload')
//            ->add('prmIdtva')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Param'
        ));
    }
}
