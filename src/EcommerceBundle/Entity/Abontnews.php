<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abontnews
 */
class Abontnews
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $anlEtat;

    /**
     * @var string
     */
    private $anlEmail;

    /**
     * @var \DateTime
     */
    private $anlDteActif;

    /**
     * @var \DateTime
     */
    private $anlDteDesact;

    /**
     * @var string
     */
    private $anlLocale;


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
     * Set anlEtat
     *
     * @param boolean $anlEtat
     * @return Abontnews
     */
    public function setAnlEtat($anlEtat)
    {
        $this->anlEtat = $anlEtat;

        return $this;
    }

    /**
     * Get anlEtat
     *
     * @return boolean 
     */
    public function getAnlEtat()
    {
        return $this->anlEtat;
    }

    /**
     * Set anlEmail
     *
     * @param string $anlEmail
     * @return Abontnews
     */
    public function setAnlEmail($anlEmail)
    {
        $this->anlEmail = $anlEmail;

        return $this;
    }

    /**
     * Get anlEmail
     *
     * @return string 
     */
    public function getAnlEmail()
    {
        return $this->anlEmail;
    }

    /**
     * Set anlDteActif
     *
     * @param \DateTime $anlDteActif
     * @return Abontnews
     */
    public function setAnlDteActif($anlDteActif)
    {
        $this->anlDteActif = $anlDteActif;

        return $this;
    }

    /**
     * Get anlDteActif
     *
     * @return \DateTime 
     */
    public function getAnlDteActif()
    {
        return $this->anlDteActif;
    }

    /**
     * Set anlDteDesact
     *
     * @param \DateTime $anlDteDesact
     * @return Abontnews
     */
    public function setAnlDteDesact($anlDteDesact)
    {
        $this->anlDteDesact = $anlDteDesact;

        return $this;
    }

    /**
     * Get anlDteDesact
     *
     * @return \DateTime 
     */
    public function getAnlDteDesact()
    {
        return $this->anlDteDesact;
    }

    /**
     * Set anlLocale
     *
     * @param string $anlLocale
     * @return Abontnews
     */
    public function setAnlLocale($anlLocale)
    {
        $this->anlLocale = $anlLocale;

        return $this;
    }

    /**
     * Get anlLocale
     *
     * @return string 
     */
    public function getAnlLocale()
    {
        return $this->anlLocale;
    }
}
