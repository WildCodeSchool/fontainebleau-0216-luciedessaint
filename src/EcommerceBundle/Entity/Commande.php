<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 */
class Commande
{
    // Code écrit

    public function __toString()
    {
        return $this->getComCode();
    }

    ///////////////////////
    // GENERATED CODE

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $comCode;

    /**
     * @var int
     */
    private $comEtat;

    /**
     * @var string
     */
    private $comCdebank;

    /**
     * @var \DateTime
     */
    private $comVenteDte;

    /**
     * @var \DateTime
     */
    private $comExpedDte;

    /**
     * @var \DateTime
     */
    private $comMajDte;

    /**
     * @var string
     */
    private $comMajWho;

    /**
     * @var string
     */
    private $comMajLib;

    /**
     * @var \DateTime
     */
    private $comAnnulDte;

    /**
     * @var string
     */
    private $comAnnulWho;

    /**
     * @var string
     */
    private $comAnnulLib;

    /**
     * @var string
     */
    private $comFact;

    /**
     * @var \DateTime
     */
    private $comFactDte;

    /**
     * @var string
     */
    private $comFactWho;

    /**
     * @var int
     */
    private $comNbArts;

    /**
     * @var bool
     */
    private $comTvaUnique;

    /**
     * @var string
     */
    private $comPrixTotHt;

    /**
     * @var string
     */
    private $comPrixTotTtc;

    /**
     * @var string
     */
    private $comEmbPoids;

    /**
     * @var string
     */
    private $comEmbDim;

    /**
     * @var string
     */
    private $comLivDelai;

    /**
     * @var string
     */
    private $comComments;


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
     * Set comCode
     *
     * @param string $comCode
     * @return Commande
     */
    public function setComCode($comCode)
    {
        $this->comCode = $comCode;

        return $this;
    }

    /**
     * Get comCode
     *
     * @return string 
     */
    public function getComCode()
    {
        return $this->comCode;
    }

    /**
     * Set comEtat
     *
     * @param integer $comEtat
     * @return Commande
     */
    public function setComEtat($comEtat)
    {
        $this->comEtat = $comEtat;

        return $this;
    }

    /**
     * Get comEtat
     *
     * @return integer 
     */
    public function getComEtat()
    {
        return $this->comEtat;
    }

    /**
     * Set comCdebank
     *
     * @param string $comCdebank
     * @return Commande
     */
    public function setComCdebank($comCdebank)
    {
        $this->comCdebank = $comCdebank;

        return $this;
    }

    /**
     * Get comCdebank
     *
     * @return string 
     */
    public function getComCdebank()
    {
        return $this->comCdebank;
    }

    /**
     * Set comVenteDte
     *
     * @param \DateTime $comVenteDte
     * @return Commande
     */
    public function setComVenteDte($comVenteDte)
    {
        $this->comVenteDte = $comVenteDte;

        return $this;
    }

    /**
     * Get comVenteDte
     *
     * @return \DateTime 
     */
    public function getComVenteDte()
    {
        return $this->comVenteDte;
    }

    /**
     * Set comExpedDte
     *
     * @param \DateTime $comExpedDte
     * @return Commande
     */
    public function setComExpedDte($comExpedDte)
    {
        $this->comExpedDte = $comExpedDte;

        return $this;
    }

    /**
     * Get comExpedDte
     *
     * @return \DateTime 
     */
    public function getComExpedDte()
    {
        return $this->comExpedDte;
    }

    /**
     * Set comMajDte
     *
     * @param \DateTime $comMajDte
     * @return Commande
     */
    public function setComMajDte($comMajDte)
    {
        $this->comMajDte = $comMajDte;

        return $this;
    }

    /**
     * Get comMajDte
     *
     * @return \DateTime 
     */
    public function getComMajDte()
    {
        return $this->comMajDte;
    }

    /**
     * Set comMajWho
     *
     * @param string $comMajWho
     * @return Commande
     */
    public function setComMajWho($comMajWho)
    {
        $this->comMajWho = $comMajWho;

        return $this;
    }

    /**
     * Get comMajWho
     *
     * @return string 
     */
    public function getComMajWho()
    {
        return $this->comMajWho;
    }

    /**
     * Set comMajLib
     *
     * @param string $comMajLib
     * @return Commande
     */
    public function setComMajLib($comMajLib)
    {
        $this->comMajLib = $comMajLib;

        return $this;
    }

    /**
     * Get comMajLib
     *
     * @return string 
     */
    public function getComMajLib()
    {
        return $this->comMajLib;
    }

    /**
     * Set comAnnulDte
     *
     * @param \DateTime $comAnnulDte
     * @return Commande
     */
    public function setComAnnulDte($comAnnulDte)
    {
        $this->comAnnulDte = $comAnnulDte;

        return $this;
    }

    /**
     * Get comAnnulDte
     *
     * @return \DateTime 
     */
    public function getComAnnulDte()
    {
        return $this->comAnnulDte;
    }

    /**
     * Set comAnnulWho
     *
     * @param string $comAnnulWho
     * @return Commande
     */
    public function setComAnnulWho($comAnnulWho)
    {
        $this->comAnnulWho = $comAnnulWho;

        return $this;
    }

    /**
     * Get comAnnulWho
     *
     * @return string 
     */
    public function getComAnnulWho()
    {
        return $this->comAnnulWho;
    }

    /**
     * Set comAnnulLib
     *
     * @param string $comAnnulLib
     * @return Commande
     */
    public function setComAnnulLib($comAnnulLib)
    {
        $this->comAnnulLib = $comAnnulLib;

        return $this;
    }

    /**
     * Get comAnnulLib
     *
     * @return string 
     */
    public function getComAnnulLib()
    {
        return $this->comAnnulLib;
    }

    /**
     * Set comFact
     *
     * @param string $comFact
     * @return Commande
     */
    public function setComFact($comFact)
    {
        $this->comFact = $comFact;

        return $this;
    }

    /**
     * Get comFact
     *
     * @return string 
     */
    public function getComFact()
    {
        return $this->comFact;
    }

    /**
     * Set comFactDte
     *
     * @param \DateTime $comFactDte
     * @return Commande
     */
    public function setComFactDte($comFactDte)
    {
        $this->comFactDte = $comFactDte;

        return $this;
    }

    /**
     * Get comFactDte
     *
     * @return \DateTime 
     */
    public function getComFactDte()
    {
        return $this->comFactDte;
    }

    /**
     * Set comFactWho
     *
     * @param string $comFactWho
     * @return Commande
     */
    public function setComFactWho($comFactWho)
    {
        $this->comFactWho = $comFactWho;

        return $this;
    }

    /**
     * Get comFactWho
     *
     * @return string 
     */
    public function getComFactWho()
    {
        return $this->comFactWho;
    }

    /**
     * Set comNbArts
     *
     * @param integer $comNbArts
     * @return Commande
     */
    public function setComNbArts($comNbArts)
    {
        $this->comNbArts = $comNbArts;

        return $this;
    }

    /**
     * Get comNbArts
     *
     * @return integer 
     */
    public function getComNbArts()
    {
        return $this->comNbArts;
    }

    /**
     * Set comTvaUnique
     *
     * @param boolean $comTvaUnique
     * @return Commande
     */
    public function setComTvaUnique($comTvaUnique)
    {
        $this->comTvaUnique = $comTvaUnique;

        return $this;
    }

    /**
     * Get comTvaUnique
     *
     * @return boolean 
     */
    public function getComTvaUnique()
    {
        return $this->comTvaUnique;
    }

    /**
     * Set comPrixTotHt
     *
     * @param string $comPrixTotHt
     * @return Commande
     */
    public function setComPrixTotHt($comPrixTotHt)
    {
        $this->comPrixTotHt = $comPrixTotHt;

        return $this;
    }

    /**
     * Get comPrixTotHt
     *
     * @return string 
     */
    public function getComPrixTotHt()
    {
        return $this->comPrixTotHt;
    }

    /**
     * Set comPrixTotTtc
     *
     * @param string $comPrixTotTtc
     * @return Commande
     */
    public function setComPrixTotTtc($comPrixTotTtc)
    {
        $this->comPrixTotTtc = $comPrixTotTtc;

        return $this;
    }

    /**
     * Get comPrixTotTtc
     *
     * @return string 
     */
    public function getComPrixTotTtc()
    {
        return $this->comPrixTotTtc;
    }

    /**
     * Set comEmbPoids
     *
     * @param string $comEmbPoids
     * @return Commande
     */
    public function setComEmbPoids($comEmbPoids)
    {
        $this->comEmbPoids = $comEmbPoids;

        return $this;
    }

    /**
     * Get comEmbPoids
     *
     * @return string 
     */
    public function getComEmbPoids()
    {
        return $this->comEmbPoids;
    }

    /**
     * Set comEmbDim
     *
     * @param string $comEmbDim
     * @return Commande
     */
    public function setComEmbDim($comEmbDim)
    {
        $this->comEmbDim = $comEmbDim;

        return $this;
    }

    /**
     * Get comEmbDim
     *
     * @return string 
     */
    public function getComEmbDim()
    {
        return $this->comEmbDim;
    }

    /**
     * Set comLivDelai
     *
     * @param string $comLivDelai
     * @return Commande
     */
    public function setComLivDelai($comLivDelai)
    {
        $this->comLivDelai = $comLivDelai;

        return $this;
    }

    /**
     * Get comLivDelai
     *
     * @return string 
     */
    public function getComLivDelai()
    {
        return $this->comLivDelai;
    }

    /**
     * Set comComments
     *
     * @param string $comComments
     * @return Commande
     */
    public function setComComments($comComments)
    {
        $this->comComments = $comComments;

        return $this;
    }

    /**
     * Get comComments
     *
     * @return string 
     */
    public function getComComments()
    {
        return $this->comComments;
    }
}
