<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 */
class Newsletter
{

    // Code écrit

    public function __toString()
    {
        return $this->getNwlLib();
    }

    public $maPJ;

    protected function getUploadDir()
    {
        return 'uploads/newsletters';
    }
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->nwlMailPj ? null : $this->getUploadDir().'/'.$this->nwlMailPj;
    }
    public function getAbsolutePath()
    {
        return null === $this->nwlMailPj ? null : $this->getUploadRootDir().'/'.$this->nwlMailPj;
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->maPJ) {
            // do whatever you want to generate a unique name
            $this->nwlMailPj = 'PJ_'.uniqid().'.'.$this->maPJ->guessExtension();
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiresAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null !== $this->maPJ) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error

            $this->maPJ->move($this->getUploadRootDir(), $this->nwlMailPj);

            unset($this->maPJ);
        }
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($maPJ = $this->getAbsolutePath()) {
            unlink($maPJ);
        }
    }

    ///////////////////////
    // GENERATED CODE
    //

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nwlLib;

    /**
     * @var string
     */
    private $nwlLocale;

    /**
     * @var string
     */
    private $nwlMailObjet;

    /**
     * @var string
     */
    private $nwlMailTexte;

    /**
     * @var string
     */
    private $nwlMailPj;

    /**
     * @var \DateTime
     */
    private $nwlDateEnvoi;

    /**
     * @var bool
     */
    private $nwlEnvoyee;

    /**
     * @var \DateTime
     */
    private $nwlEnvDate;


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
     * Set nwlLib
     *
     * @param string $nwlLib
     * @return Newsletter
     */
    public function setNwlLib($nwlLib)
    {
        $this->nwlLib = $nwlLib;

        return $this;
    }

    /**
     * Get nwlLib
     *
     * @return string 
     */
    public function getNwlLib()
    {
        return $this->nwlLib;
    }

    /**
     * Set nwlLocale
     *
     * @param string $nwlLocale
     * @return Newsletter
     */
    public function setNwlLocale($nwlLocale)
    {
        $this->nwlLocale = $nwlLocale;

        return $this;
    }

    /**
     * Get nwlLocale
     *
     * @return string 
     */
    public function getNwlLocale()
    {
        return $this->nwlLocale;
    }

    /**
     * Set nwlMailObjet
     *
     * @param string $nwlMailObjet
     * @return Newsletter
     */
    public function setNwlMailObjet($nwlMailObjet)
    {
        $this->nwlMailObjet = $nwlMailObjet;

        return $this;
    }

    /**
     * Get nwlMailObjet
     *
     * @return string 
     */
    public function getNwlMailObjet()
    {
        return $this->nwlMailObjet;
    }

    /**
     * Set nwlMailTexte
     *
     * @param string $nwlMailTexte
     * @return Newsletter
     */
    public function setNwlMailTexte($nwlMailTexte)
    {
        $this->nwlMailTexte = $nwlMailTexte;

        return $this;
    }

    /**
     * Get nwlMailTexte
     *
     * @return string 
     */
    public function getNwlMailTexte()
    {
        return $this->nwlMailTexte;
    }

    /**
     * Set nwlMailPj
     *
     * @param string $nwlMailPj
     * @return Newsletter
     */
    public function setNwlMailPj($nwlMailPj)
    {
        $this->nwlMailPj = $nwlMailPj;

        return $this;
    }

    /**
     * Get nwlMailPj
     *
     * @return string 
     */
    public function getNwlMailPj()
    {
        return $this->nwlMailPj;
    }

    /**
     * Set nwlDateEnvoi
     *
     * @param \DateTime $nwlDateEnvoi
     * @return Newsletter
     */
    public function setNwlDateEnvoi($nwlDateEnvoi)
    {
        $this->nwlDateEnvoi = $nwlDateEnvoi;

        return $this;
    }

    /**
     * Get nwlDateEnvoi
     *
     * @return \DateTime 
     */
    public function getNwlDateEnvoi()
    {
        return $this->nwlDateEnvoi;
    }

    /**
     * Set nwlEnvoyee
     *
     * @param boolean $nwlEnvoyee
     * @return Newsletter
     */
    public function setNwlEnvoyee($nwlEnvoyee)
    {
        $this->nwlEnvoyee = $nwlEnvoyee;

        return $this;
    }

    /**
     * Get nwlEnvoyee
     *
     * @return boolean 
     */
    public function getNwlEnvoyee()
    {
        return $this->nwlEnvoyee;
    }

    /**
     * Set nwlEnvDate
     *
     * @param \DateTime $nwlEnvDate
     * @return Newsletter
     */
    public function setNwlEnvDate($nwlEnvDate)
    {
        $this->nwlEnvDate = $nwlEnvDate;

        return $this;
    }

    /**
     * Get nwlEnvDate
     *
     * @return \DateTime 
     */
    public function getNwlEnvDate()
    {
        return $this->nwlEnvDate;
    }
    /**
     * @var string
     */
    private $nwlMailDests;


    /**
     * Set nwlMailDests
     *
     * @param string $nwlMailDests
     * @return Newsletter
     */
    public function setNwlMailDests($nwlMailDests)
    {
        $this->nwlMailDests = $nwlMailDests;

        return $this;
    }

    /**
     * Get nwlMailDests
     *
     * @return string 
     */
    public function getNwlMailDests()
    {
        return $this->nwlMailDests;
    }
    /**
     * @var \DateTime
     */
    private $nwlDatePrev;


    /**
     * Set nwlDatePrev
     *
     * @param \DateTime $nwlDatePrev
     * @return Newsletter
     */
    public function setNwlDatePrev($nwlDatePrev)
    {
        $this->nwlDatePrev = $nwlDatePrev;

        return $this;
    }

    /**
     * Get nwlDatePrev
     *
     * @return \DateTime 
     */
    public function getNwlDatePrev()
    {
        return $this->nwlDatePrev;
    }
}
