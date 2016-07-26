<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LangType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('lngCode')
            ->add("lngCode", "choice", array(
                "label" => "Code langue :",
                "choices" => array(
                    "fr" => "fr",
                    "en" => "en",
                    "de" => "de",
                    "it" => "it",
                    "es" => "es",
                    "pt" => "pt",
                    "el" => "el",
                    "ja" => "ja",
                    "zh" => "zh",
                    "ko" => "ko",
                    "ru" => "ru"
                )
            ))
/*                    "fr - Français" => "fr",
                    "en - English" => "en",
                    "de - Deutsch" => "de",
                    "it - Italiano" => "it",
                    "es - Español" => "es",
                    "pt - Português" => "pt",
                    "el - ελληνικά (Grec)" => "el",
                    "ja - 日本の (Japonais)" => "ja",
                    "zh - 中国 (Chinois)" => "zh",
                    "ko - 한국의 (Coréen)" => "ko",
                    "ru - русский (Russe)" => "ru"*/
//            ->add('lngLib')
            ->add("lngLib", "choice", array(
                "label" => "Langue :",
                "choices" => array(
                    "Français" => "Français",
                    "English" => "English",
                    "Deutsch" => "Deutsch",
                    "Italiano" => "Italiano",
                    "Español" => "Español",
                    "Português" => "Português",
                    "中国" => "中国 (Chinois)",
                    "ελληνικά" => "ελληνικά (Grec)",
                    "日本の" => "日本の (Japonais)",
                    "한국의" => "한국의 (Coréen)",
                    "русский" => "русский (Russe)"
                )
            ))
            ->add('file', 'file', array('label' => ' ', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Lang'
        ));
    }
}
