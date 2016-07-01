<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdlibType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pdlLocale')
            ->add('pdlLib')
            ->add('pdlDesc')
            ->add('pdlCat')
            ->add('pdlType')
            ->add('pdlItem')
            ->add('pdlInfoLib1')
            ->add('pdlInfoLib2')
            ->add('pdlInfoLib3')
            ->add('pdlInfoLib4')
            ->add('pdlInfoLib5')
            ->add('pdlInfoLib6')
            ->add('pdlInfoLib7')
            ->add('pdlInfoLib8')
            ->add('pdlInfoLib9')
            ->add('pdlInfoVal1')
            ->add('pdlInfoVal2')
            ->add('pdlInfoVal3')
            ->add('pdlInfoVal4')
            ->add('pdlInfoVal5')
            ->add('pdlInfoVal6')
            ->add('pdlInfoVal7')
            ->add('pdlInfoVal8')
            ->add('pdlInfoVal9')
            ->add('pdlPckgComm')
            ->add('pdlDispo')
            ->add('pdlFabDelai')
            ->add('pdlLivDelai')
            ->add('pdlIdpdt')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Prodlib'
        ));
    }
}
