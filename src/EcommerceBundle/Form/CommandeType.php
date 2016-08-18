<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
//            ->add('comEtat')
            ->add("comEtat", "choice", array(
                "label" => "Etat :",
                "choices" => array(
                    0 => "Saisie",
                    1 => "Confirmée",
                    2 => "En préparation",
                    3 => "Expédiée",
                    4 => "Reçue",
                    5 => "Close",
                    9 => "Annulée"
                )
            ))
            ->add('comCdebank')
//            ->add('comVenteDte', 'datetime')
            ->add('comExpedDte', 'datetime')
/*            ->add('comExpedDte', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ))*/
/*            ->add('comExpedDte','date',array(
                    'label' => 'Date expédition',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'datepicker') <br>))*/
//            ->add('comMajDte', 'datetime')
//            ->add('comMajWho')
            ->add('comMajLib')
//            ->add('comAnnulDte', 'datetime')
//            ->add('comAnnulWho')
            ->add('comAnnulLib')
            ->add('comFact')
            ->add('comFactDte', 'datetime')
//            ->add('comFactWho')
            ->add('comNbArts')
//            ->add('comTvaUnique')
            ->add('comPrixTotHt', MoneyType::class)
            ->add('comPrixTotTtc', MoneyType::class)
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
