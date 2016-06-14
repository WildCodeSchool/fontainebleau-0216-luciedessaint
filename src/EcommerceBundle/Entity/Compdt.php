<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compdt
 */
class Compdt
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $cPNbpdt;


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
     * Set cPNbpdt
     *
     * @param integer $cPNbpdt
     * @return Compdt
     */
    public function setCPNbpdt($cPNbpdt)
    {
        $this->cPNbpdt = $cPNbpdt;

        return $this;
    }

    /**
     * Get cPNbpdt
     *
     * @return integer 
     */
    public function getCPNbpdt()
    {
        return $this->cPNbpdt;
    }
    /**
     * @var integer
     */
    private $cxpNbpdt;

    /**
     * @var \EcommerceBundle\Entity\Produit
     */
    private $cxpIdpdt;

    /**
     * @var \EcommerceBundle\Entity\Commande
     */
    private $cxpIdcom;


    /**
     * Set cxpNbpdt
     *
     * @param integer $cxpNbpdt
     * @return Compdt
     */
    public function setCxpNbpdt($cxpNbpdt)
    {
        $this->cxpNbpdt = $cxpNbpdt;

        return $this;
    }

    /**
     * Get cxpNbpdt
     *
     * @return integer 
     */
    public function getCxpNbpdt()
    {
        return $this->cxpNbpdt;
    }

    /**
     * Set cxpIdpdt
     *
     * @param \EcommerceBundle\Entity\Produit $cxpIdpdt
     * @return Compdt
     */
    public function setCxpIdpdt(\EcommerceBundle\Entity\Produit $cxpIdpdt = null)
    {
        $this->cxpIdpdt = $cxpIdpdt;

        return $this;
    }

    /**
     * Get cxpIdpdt
     *
     * @return \EcommerceBundle\Entity\Produit 
     */
    public function getCxpIdpdt()
    {
        return $this->cxpIdpdt;
    }

    /**
     * Set cxpIdcom
     *
     * @param \EcommerceBundle\Entity\Commande $cxpIdcom
     * @return Compdt
     */
    public function setCxpIdcom(\EcommerceBundle\Entity\Commande $cxpIdcom = null)
    {
        $this->cxpIdcom = $cxpIdcom;

        return $this;
    }

    /**
     * Get cxpIdcom
     *
     * @return \EcommerceBundle\Entity\Commande 
     */
    public function getCxpIdcom()
    {
        return $this->cxpIdcom;
    }
}
