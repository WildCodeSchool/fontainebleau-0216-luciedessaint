<?php

namespace EcommerceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdresseClient
 */
class AdresseClient
{
    public function __construct()
    {
        $this->adresse = new ArrayCollection();
    }

    // GENERATED CODE

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \EcommerceBundle\Entity\AdresseModele
     */
    private $adresse;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adresse
     *
     * @param \EcommerceBundle\Entity\AdresseModele $adresse
     * @return AdresseClient
     */
    public function setAdresse(\EcommerceBundle\Entity\AdresseModele $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \EcommerceBundle\Entity\AdresseModele 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
