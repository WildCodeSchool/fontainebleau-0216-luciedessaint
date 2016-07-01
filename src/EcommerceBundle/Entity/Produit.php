<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 */
class Produit
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $pdtEtat;

    /**
     * @var boolean
     */
    private $pdtAvendre;

    /**
     * @var boolean
     */
    private $pdtAffNostock;

    /**
     * @var boolean
     */
    private $pdtAffPrix;

    /**
     * @var string
     */
    private $pdtNom;

    /**
     * @var string
     */
    private $pdtRef;

    /**
     * @var string
     */
    private $pdtPrixUnitHt;

    /**
     * @var string
     */
    private $pdtPrixUnitTtc;

    /**
     * @var integer
     */
    private $pdtPromoPct;

    /**
     * @var string
     */
    private $pdtPromoHt;

    /**
     * @var string
     */
    private $pdtPromoTtc;

    /**
     * @var string
     */
    private $pdtPhoto;

    /**
     * @var string
     */
    private $pdtPhoto2;

    /**
     * @var string
     */
    private $pdtPhoto3;

    /**
     * @var string
     */
    private $pdtPhoto4;

    /**
     * @var string
     */
    private $pdtPhoto5;

    /**
     * @var string
     */
    private $pdtPoids;

    /**
     * @var string
     */
    private $pdtDim;

    /**
     * @var string
     */
    private $pdtEmbPoids;

    /**
     * @var string
     */
    private $pdtEmbDim;

    /**
     * @var string
     */
    private $pdtPckgPhoto;

    /**
     * @var \EcommerceBundle\Entity\Tva
     */
    private $pdtIdtva;


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
     * Set pdtEtat
     *
     * @param boolean $pdtEtat
     * @return Produit
     */
    public function setPdtEtat($pdtEtat)
    {
        $this->pdtEtat = $pdtEtat;

        return $this;
    }

    /**
     * Get pdtEtat
     *
     * @return boolean 
     */
    public function getPdtEtat()
    {
        return $this->pdtEtat;
    }

    /**
     * Set pdtAvendre
     *
     * @param boolean $pdtAvendre
     * @return Produit
     */
    public function setPdtAvendre($pdtAvendre)
    {
        $this->pdtAvendre = $pdtAvendre;

        return $this;
    }

    /**
     * Get pdtAvendre
     *
     * @return boolean 
     */
    public function getPdtAvendre()
    {
        return $this->pdtAvendre;
    }

    /**
     * Set pdtAffNostock
     *
     * @param boolean $pdtAffNostock
     * @return Produit
     */
    public function setPdtAffNostock($pdtAffNostock)
    {
        $this->pdtAffNostock = $pdtAffNostock;

        return $this;
    }

    /**
     * Get pdtAffNostock
     *
     * @return boolean 
     */
    public function getPdtAffNostock()
    {
        return $this->pdtAffNostock;
    }

    /**
     * Set pdtAffPrix
     *
     * @param boolean $pdtAffPrix
     * @return Produit
     */
    public function setPdtAffPrix($pdtAffPrix)
    {
        $this->pdtAffPrix = $pdtAffPrix;

        return $this;
    }

    /**
     * Get pdtAffPrix
     *
     * @return boolean 
     */
    public function getPdtAffPrix()
    {
        return $this->pdtAffPrix;
    }

    /**
     * Set pdtNom
     *
     * @param string $pdtNom
     * @return Produit
     */
    public function setPdtNom($pdtNom)
    {
        $this->pdtNom = $pdtNom;

        return $this;
    }

    /**
     * Get pdtNom
     *
     * @return string 
     */
    public function getPdtNom()
    {
        return $this->pdtNom;
    }

    /**
     * Set pdtRef
     *
     * @param string $pdtRef
     * @return Produit
     */
    public function setPdtRef($pdtRef)
    {
        $this->pdtRef = $pdtRef;

        return $this;
    }

    /**
     * Get pdtRef
     *
     * @return string 
     */
    public function getPdtRef()
    {
        return $this->pdtRef;
    }

    /**
     * Set pdtPrixUnitHt
     *
     * @param string $pdtPrixUnitHt
     * @return Produit
     */
    public function setPdtPrixUnitHt($pdtPrixUnitHt)
    {
        $this->pdtPrixUnitHt = $pdtPrixUnitHt;

        return $this;
    }

    /**
     * Get pdtPrixUnitHt
     *
     * @return string 
     */
    public function getPdtPrixUnitHt()
    {
        return $this->pdtPrixUnitHt;
    }

    /**
     * Set pdtPrixUnitTtc
     *
     * @param string $pdtPrixUnitTtc
     * @return Produit
     */
    public function setPdtPrixUnitTtc($pdtPrixUnitTtc)
    {
        $this->pdtPrixUnitTtc = $pdtPrixUnitTtc;

        return $this;
    }

    /**
     * Get pdtPrixUnitTtc
     *
     * @return string 
     */
    public function getPdtPrixUnitTtc()
    {
        return $this->pdtPrixUnitTtc;
    }

    /**
     * Set pdtPromoPct
     *
     * @param integer $pdtPromoPct
     * @return Produit
     */
    public function setPdtPromoPct($pdtPromoPct)
    {
        $this->pdtPromoPct = $pdtPromoPct;

        return $this;
    }

    /**
     * Get pdtPromoPct
     *
     * @return integer 
     */
    public function getPdtPromoPct()
    {
        return $this->pdtPromoPct;
    }

    /**
     * Set pdtPromoHt
     *
     * @param string $pdtPromoHt
     * @return Produit
     */
    public function setPdtPromoHt($pdtPromoHt)
    {
        $this->pdtPromoHt = $pdtPromoHt;

        return $this;
    }

    /**
     * Get pdtPromoHt
     *
     * @return string 
     */
    public function getPdtPromoHt()
    {
        return $this->pdtPromoHt;
    }

    /**
     * Set pdtPromoTtc
     *
     * @param string $pdtPromoTtc
     * @return Produit
     */
    public function setPdtPromoTtc($pdtPromoTtc)
    {
        $this->pdtPromoTtc = $pdtPromoTtc;

        return $this;
    }

    /**
     * Get pdtPromoTtc
     *
     * @return string 
     */
    public function getPdtPromoTtc()
    {
        return $this->pdtPromoTtc;
    }

    /**
     * Set pdtPhoto
     *
     * @param string $pdtPhoto
     * @return Produit
     */
    public function setPdtPhoto($pdtPhoto)
    {
        $this->pdtPhoto = $pdtPhoto;

        return $this;
    }

    /**
     * Get pdtPhoto
     *
     * @return string 
     */
    public function getPdtPhoto()
    {
        return $this->pdtPhoto;
    }

    /**
     * Set pdtPhoto2
     *
     * @param string $pdtPhoto2
     * @return Produit
     */
    public function setPdtPhoto2($pdtPhoto2)
    {
        $this->pdtPhoto2 = $pdtPhoto2;

        return $this;
    }

    /**
     * Get pdtPhoto2
     *
     * @return string 
     */
    public function getPdtPhoto2()
    {
        return $this->pdtPhoto2;
    }

    /**
     * Set pdtPhoto3
     *
     * @param string $pdtPhoto3
     * @return Produit
     */
    public function setPdtPhoto3($pdtPhoto3)
    {
        $this->pdtPhoto3 = $pdtPhoto3;

        return $this;
    }

    /**
     * Get pdtPhoto3
     *
     * @return string 
     */
    public function getPdtPhoto3()
    {
        return $this->pdtPhoto3;
    }

    /**
     * Set pdtPhoto4
     *
     * @param string $pdtPhoto4
     * @return Produit
     */
    public function setPdtPhoto4($pdtPhoto4)
    {
        $this->pdtPhoto4 = $pdtPhoto4;

        return $this;
    }

    /**
     * Get pdtPhoto4
     *
     * @return string 
     */
    public function getPdtPhoto4()
    {
        return $this->pdtPhoto4;
    }

    /**
     * Set pdtPhoto5
     *
     * @param string $pdtPhoto5
     * @return Produit
     */
    public function setPdtPhoto5($pdtPhoto5)
    {
        $this->pdtPhoto5 = $pdtPhoto5;

        return $this;
    }

    /**
     * Get pdtPhoto5
     *
     * @return string 
     */
    public function getPdtPhoto5()
    {
        return $this->pdtPhoto5;
    }

    /**
     * Set pdtPoids
     *
     * @param string $pdtPoids
     * @return Produit
     */
    public function setPdtPoids($pdtPoids)
    {
        $this->pdtPoids = $pdtPoids;

        return $this;
    }

    /**
     * Get pdtPoids
     *
     * @return string 
     */
    public function getPdtPoids()
    {
        return $this->pdtPoids;
    }

    /**
     * Set pdtDim
     *
     * @param string $pdtDim
     * @return Produit
     */
    public function setPdtDim($pdtDim)
    {
        $this->pdtDim = $pdtDim;

        return $this;
    }

    /**
     * Get pdtDim
     *
     * @return string 
     */
    public function getPdtDim()
    {
        return $this->pdtDim;
    }

    /**
     * Set pdtEmbPoids
     *
     * @param string $pdtEmbPoids
     * @return Produit
     */
    public function setPdtEmbPoids($pdtEmbPoids)
    {
        $this->pdtEmbPoids = $pdtEmbPoids;

        return $this;
    }

    /**
     * Get pdtEmbPoids
     *
     * @return string 
     */
    public function getPdtEmbPoids()
    {
        return $this->pdtEmbPoids;
    }

    /**
     * Set pdtEmbDim
     *
     * @param string $pdtEmbDim
     * @return Produit
     */
    public function setPdtEmbDim($pdtEmbDim)
    {
        $this->pdtEmbDim = $pdtEmbDim;

        return $this;
    }

    /**
     * Get pdtEmbDim
     *
     * @return string 
     */
    public function getPdtEmbDim()
    {
        return $this->pdtEmbDim;
    }

    /**
     * Set pdtPckgPhoto
     *
     * @param string $pdtPckgPhoto
     * @return Produit
     */
    public function setPdtPckgPhoto($pdtPckgPhoto)
    {
        $this->pdtPckgPhoto = $pdtPckgPhoto;

        return $this;
    }

    /**
     * Get pdtPckgPhoto
     *
     * @return string 
     */
    public function getPdtPckgPhoto()
    {
        return $this->pdtPckgPhoto;
    }

    /**
     * Set pdtIdtva
     *
     * @param \EcommerceBundle\Entity\Tva $pdtIdtva
     * @return Produit
     */
    public function setPdtIdtva(\EcommerceBundle\Entity\Tva $pdtIdtva = null)
    {
        $this->pdtIdtva = $pdtIdtva;

        return $this;
    }

    /**
     * Get pdtIdtva
     *
     * @return \EcommerceBundle\Entity\Tva 
     */
    public function getPdtIdtva()
    {
        return $this->pdtIdtva;
    }
}
