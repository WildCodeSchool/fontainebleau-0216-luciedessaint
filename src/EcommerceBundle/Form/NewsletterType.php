<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nwlLib')
//            ->add('nwlLocale')
            ->add("nwlLocale", "choice", array(
                "label" => "Langue :",
                "choices" => array(
                    "xx" => "xx - --toutes--",
                    "fr" => "fr - Français",
                    "en" => "en - English",
                    "de" => "de - Deutsch",
                    "it" => "it - Italiano",
                    "es" => "es - Español",
                    "pt" => "pt - Português",
                    "zh" => "zh - 中国 (Chinois)",
                    "el" => "el - ελληνικά (Grec)",
                    "ja" => "ja - 日本の (Japonais)",
                    "ko" => "ko - 한국의 (Coréen)",
                    "ru" => "ru - русский (Russe)"
                )
            ))
            ->add('nwlMailObjet')
            //->add('nwlMailTexte')
            ->add('nwlMailTexte', 'textarea', array(
                    'label' => 'Texte du mail',
                    'attr' => array(
                        'class' => 'tinymce',
                        //'data-theme' => 'bbcode' // Skip it if you want to use default theme
                    )
            ))
            //->add('nwlMailPj')
            ->add('maPJ', 'file', array('label' => 'Newsletter en pièce jointe', 'required' => false))
            ->add('nwlDatePrev', 'date')
/*            ->add('nwlDatePrev', DateType::class, array(
                'widget' => 'single_text',
                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,
                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ))*/
            ->add('nwlEnvoyee')
            ->add('nwlEnvDate', 'datetime')
            ->add('nwlMailDests')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Newsletter'
        ));
    }
}
