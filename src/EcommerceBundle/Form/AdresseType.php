<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adrType')
            ->add('adrNom')
            ->add('adrPrenom')
            ->add('adrSoc')
            ->add('adrEmail')
            ->add('adrAdr')
            ->add('adrAdr2')
            ->add('adrCp')
            ->add('adrVille')
            ->add('adrPays')
            ->add('adrIdcom')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Adresse'
        ));
    }
}
