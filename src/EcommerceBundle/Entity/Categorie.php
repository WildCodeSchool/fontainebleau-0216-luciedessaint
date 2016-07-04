<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 */
class Categorie
{

    ///////////////////////
    // GENERATED CODE

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $catLibAdmin;

    /**
     * @var integer
     */
    private $catNiv;

    /**
     * @var boolean
     */
    private $catAvendre;

    /**
     * @var boolean
     */
    private $catAffPrix;

    /**
     * @var boolean
     */
    private $catAffNostock;

    /**
     * @var boolean
     */
    private $catAffVendu;

    /**
     * @var string
     */
    private $catPhoto;

    /**
     * @var \EcommerceBundle\Entity\Tva
     */
    private $catIdtva;


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
     * Set catLibAdmin
     *
     * @param string $catLibAdmin
     * @return Categorie
     */
    public function setCatLibAdmin($catLibAdmin)
    {
        $this->catLibAdmin = $catLibAdmin;

        return $this;
    }

    /**
     * Get catLibAdmin
     *
     * @return string 
     */
    public function getCatLibAdmin()
    {
        return $this->catLibAdmin;
    }

    /**
     * Set catNiv
     *
     * @param integer $catNiv
     * @return Categorie
     */
    public function setCatNiv($catNiv)
    {
        $this->catNiv = $catNiv;

        return $this;
    }

    /**
     * Get catNiv
     *
     * @return integer 
     */
    public function getCatNiv()
    {
        return $this->catNiv;
    }

    /**
     * Set catAvendre
     *
     * @param boolean $catAvendre
     * @return Categorie
     */
    public function setCatAvendre($catAvendre)
    {
        $this->catAvendre = $catAvendre;

        return $this;
    }

    /**
     * Get catAvendre
     *
     * @return boolean 
     */
    public function getCatAvendre()
    {
        return $this->catAvendre;
    }

    /**
     * Set catAffPrix
     *
     * @param boolean $catAffPrix
     * @return Categorie
     */
    public function setCatAffPrix($catAffPrix)
    {
        $this->catAffPrix = $catAffPrix;

        return $this;
    }

    /**
     * Get catAffPrix
     *
     * @return boolean 
     */
    public function getCatAffPrix()
    {
        return $this->catAffPrix;
    }

    /**
     * Set catAffNostock
     *
     * @param boolean $catAffNostock
     * @return Categorie
     */
    public function setCatAffNostock($catAffNostock)
    {
        $this->catAffNostock = $catAffNostock;

        return $this;
    }

    /**
     * Get catAffNostock
     *
     * @return boolean 
     */
    public function getCatAffNostock()
    {
        return $this->catAffNostock;
    }

    /**
     * Set catAffVendu
     *
     * @param boolean $catAffVendu
     * @return Categorie
     */
    public function setCatAffVendu($catAffVendu)
    {
        $this->catAffVendu = $catAffVendu;

        return $this;
    }

    /**
     * Get catAffVendu
     *
     * @return boolean 
     */
    public function getCatAffVendu()
    {
        return $this->catAffVendu;
    }

    /**
     * Set catPhoto
     *
     * @param string $catPhoto
     * @return Categorie
     */
    public function setCatPhoto($catPhoto)
    {
        $this->catPhoto = $catPhoto;

        return $this;
    }

    /**
     * Get catPhoto
     *
     * @return string 
     */
    public function getCatPhoto()
    {
        return $this->catPhoto;
    }

    /**
     * Set catIdtva
     *
     * @param \EcommerceBundle\Entity\Tva $catIdtva
     * @return Categorie
     */
    public function setCatIdtva(\EcommerceBundle\Entity\Tva $catIdtva = null)
    {
        $this->catIdtva = $catIdtva;

        return $this;
    }

    /**
     * Get catIdtva
     *
     * @return \EcommerceBundle\Entity\Tva 
     */
    public function getCatIdtva()
    {
        return $this->catIdtva;
    }
}
