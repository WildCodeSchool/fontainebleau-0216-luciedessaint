<?php

namespace EcommerceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 */
class AdresseModele
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $adrTypeName;

    /**
     * @var string
     */
    private $adrNom;

    /**
     * @var string
     */
    private $adrPrenom;

    /**
     * @var string
     */
    private $adrSoc;

    /**
     * @var string
     */
    private $adrEmail;

    /**
     * @var string
     */
    private $adrTel;

    /**
     * @var string
     */
    private $adrAdr;

    /**
     * @var string
     */
    private $adrCp;

    /**
     * @var string
     */
    private $adrVille;

    /**
     * @var string
     */
    private $adrPays;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $AdresseModele;

    /**
     * @var \EcommerceBundle\Entity\Commande
     */
    private $adrIdcom;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->AdresseModele = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set adrTypeName
     *
     * @param string $adrTypeName
     * @return AdresseModele
     */
    public function setAdrTypeName($adrTypeName)
    {
        $this->adrTypeName = $adrTypeName;

        return $this;
    }

    /**
     * Get adrTypeName
     *
     * @return string 
     */
    public function getAdrTypeName()
    {
        return $this->adrTypeName;
    }

    /**
     * Set adrNom
     *
     * @param string $adrNom
     * @return AdresseModele
     */
    public function setAdrNom($adrNom)
    {
        $this->adrNom = $adrNom;

        return $this;
    }

    /**
     * Get adrNom
     *
     * @return string 
     */
    public function getAdrNom()
    {
        return $this->adrNom;
    }

    /**
     * Set adrPrenom
     *
     * @param string $adrPrenom
     * @return AdresseModele
     */
    public function setAdrPrenom($adrPrenom)
    {
        $this->adrPrenom = $adrPrenom;

        return $this;
    }

    /**
     * Get adrPrenom
     *
     * @return string 
     */
    public function getAdrPrenom()
    {
        return $this->adrPrenom;
    }

    /**
     * Set adrSoc
     *
     * @param string $adrSoc
     * @return AdresseModele
     */
    public function setAdrSoc($adrSoc)
    {
        $this->adrSoc = $adrSoc;

        return $this;
    }

    /**
     * Get adrSoc
     *
     * @return string 
     */
    public function getAdrSoc()
    {
        return $this->adrSoc;
    }

    /**
     * Set adrEmail
     *
     * @param string $adrEmail
     * @return AdresseModele
     */
    public function setAdrEmail($adrEmail)
    {
        $this->adrEmail = $adrEmail;

        return $this;
    }

    /**
     * Get adrEmail
     *
     * @return string 
     */
    public function getAdrEmail()
    {
        return $this->adrEmail;
    }

    /**
     * Set adrTel
     *
     * @param string $adrTel
     * @return AdresseModele
     */
    public function setAdrTel($adrTel)
    {
        $this->adrTel = $adrTel;

        return $this;
    }

    /**
     * Get adrTel
     *
     * @return string 
     */
    public function getAdrTel()
    {
        return $this->adrTel;
    }

    /**
     * Set adrAdr
     *
     * @param string $adrAdr
     * @return AdresseModele
     */
    public function setAdrAdr($adrAdr)
    {
        $this->adrAdr = $adrAdr;

        return $this;
    }

    /**
     * Get adrAdr
     *
     * @return string 
     */
    public function getAdrAdr()
    {
        return $this->adrAdr;
    }

    /**
     * Set adrCp
     *
     * @param string $adrCp
     * @return AdresseModele
     */
    public function setAdrCp($adrCp)
    {
        $this->adrCp = $adrCp;

        return $this;
    }

    /**
     * Get adrCp
     *
     * @return string 
     */
    public function getAdrCp()
    {
        return $this->adrCp;
    }

    /**
     * Set adrVille
     *
     * @param string $adrVille
     * @return AdresseModele
     */
    public function setAdrVille($adrVille)
    {
        $this->adrVille = $adrVille;

        return $this;
    }

    /**
     * Get adrVille
     *
     * @return string 
     */
    public function getAdrVille()
    {
        return $this->adrVille;
    }

    /**
     * Set adrPays
     *
     * @param string $adrPays
     * @return AdresseModele
     */
    public function setAdrPays($adrPays)
    {
        $this->adrPays = $adrPays;

        return $this;
    }

    /**
     * Get adrPays
     *
     * @return string 
     */
    public function getAdrPays()
    {
        return $this->adrPays;
    }

    /**
     * Add AdresseModele
     *
     * @param \EcommerceBundle\Entity\AdresseModele $adresseModele
     * @return AdresseModele
     */
    public function addAdresseModele(\EcommerceBundle\Entity\AdresseModele $adresseModele)
    {
        $this->AdresseModele[] = $adresseModele;

        return $this;
    }

    /**
     * Remove AdresseModele
     *
     * @param \EcommerceBundle\Entity\AdresseModele $adresseModele
     */
    public function removeAdresseModele(\EcommerceBundle\Entity\AdresseModele $adresseModele)
    {
        $this->AdresseModele->removeElement($adresseModele);
    }

    /**
     * Get AdresseModele
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresseModele()
    {
        return $this->AdresseModele;
    }

    /**
     * Set adrIdcom
     *
     * @param \EcommerceBundle\Entity\Commande $adrIdcom
     * @return AdresseModele
     */
    public function setAdrIdcom(\EcommerceBundle\Entity\Commande $adrIdcom = null)
    {
        $this->adrIdcom = $adrIdcom;

        return $this;
    }

    /**
     * Get adrIdcom
     *
     * @return \EcommerceBundle\Entity\Commande 
     */
    public function getAdrIdcom()
    {
        return $this->adrIdcom;
    }
}
