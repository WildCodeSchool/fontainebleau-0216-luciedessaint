<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatlibType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('ctlLocale')
            ->add('ctlCateg')
            ->add('ctlType')
            ->add('ctlItem')
            ->add('ctlLib')
            ->add('ctlInfoLib1')
            ->add('ctlInfoLib2')
            ->add('ctlInfoLib3')
            ->add('ctlInfoLib4')
            ->add('ctlInfoLib5')
            ->add('ctlInfoLib6')
            ->add('ctlInfoLib7')
            ->add('ctlInfoLib8')
            ->add('ctlInfoLib9')
//            ->add('ctlIdcat')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Catlib'
        ));
    }
}
