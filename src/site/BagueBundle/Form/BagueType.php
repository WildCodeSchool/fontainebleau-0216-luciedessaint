<?php

namespace site\BagueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BagueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prixttc')
            ->add('metaux')
            ->add('sexe', ChoiceType::class, array(
                'choices' => array(
                    'homme' => 'Homme',
                    'femme' => 'Femme'
                ),
                'required'    => false,
                'placeholder' => 'Choix',
                'empty_data'  => null
            ))
            ->add('garantie', ChoiceType::class, array(
                'choices' => array(
                    '1 ans' => '1 ans',
                    '2 ans' => '2 ans',
                    '3 ans' => '3 ans'
                ),
                'required'    => false,
                'placeholder' => 'Choix',
                'empty_data'  => null
            ))
            ->add('largeur')
            ->add('file', 'file', array('label' => 'Photo', 'required' => true))
            ->add('reference')
        ;;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'site\BagueBundle\Entity\Bague'
        ));
    }
}
