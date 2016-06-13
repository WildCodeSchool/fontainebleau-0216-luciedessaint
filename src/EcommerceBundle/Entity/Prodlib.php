<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prodlib
 */
class Prodlib
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $pdlLocale;

    /**
     * @var string
     */
    private $pdlLib;

    /**
     * @var string
     */
    private $pdlDesc;

    /**
     * @var string
     */
    private $pdlCat;

    /**
     * @var string
     */
    private $pdlType;

    /**
     * @var string
     */
    private $pdlItem;

    /**
     * @var string
     */
    private $pdlInfoLib1;

    /**
     * @var string
     */
    private $pdlInfoLib2;

    /**
     * @var string
     */
    private $pdlInfoLib3;

    /**
     * @var string
     */
    private $pdlInfoLib4;

    /**
     * @var string
     */
    private $pdlInfoLib5;

    /**
     * @var string
     */
    private $pdlInfoLib6;

    /**
     * @var string
     */
    private $pdlInfoLib7;

    /**
     * @var string
     */
    private $pdlInfoLib8;

    /**
     * @var string
     */
    private $pdlInfoLib9;

    /**
     * @var string
     */
    private $pdlPckgComm;

    /**
     * @var string
     */
    private $pdlDispo;

    /**
     * @var string
     */
    private $pdlFabDelai;

    /**
     * @var string
     */
    private $pdlLivDelai;


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
     * Set pdlLocale
     *
     * @param string $pdlLocale
     * @return Prodlib
     */
    public function setPdlLocale($pdlLocale)
    {
        $this->pdlLocale = $pdlLocale;

        return $this;
    }

    /**
     * Get pdlLocale
     *
     * @return string 
     */
    public function getPdlLocale()
    {
        return $this->pdlLocale;
    }

    /**
     * Set pdlLib
     *
     * @param string $pdlLib
     * @return Prodlib
     */
    public function setPdlLib($pdlLib)
    {
        $this->pdlLib = $pdlLib;

        return $this;
    }

    /**
     * Get pdlLib
     *
     * @return string 
     */
    public function getPdlLib()
    {
        return $this->pdlLib;
    }

    /**
     * Set pdlDesc
     *
     * @param string $pdlDesc
     * @return Prodlib
     */
    public function setPdlDesc($pdlDesc)
    {
        $this->pdlDesc = $pdlDesc;

        return $this;
    }

    /**
     * Get pdlDesc
     *
     * @return string 
     */
    public function getPdlDesc()
    {
        return $this->pdlDesc;
    }

    /**
     * Set pdlCat
     *
     * @param string $pdlCat
     * @return Prodlib
     */
    public function setPdlCat($pdlCat)
    {
        $this->pdlCat = $pdlCat;

        return $this;
    }

    /**
     * Get pdlCat
     *
     * @return string 
     */
    public function getPdlCat()
    {
        return $this->pdlCat;
    }

    /**
     * Set pdlType
     *
     * @param string $pdlType
     * @return Prodlib
     */
    public function setPdlType($pdlType)
    {
        $this->pdlType = $pdlType;

        return $this;
    }

    /**
     * Get pdlType
     *
     * @return string 
     */
    public function getPdlType()
    {
        return $this->pdlType;
    }

    /**
     * Set pdlItem
     *
     * @param string $pdlItem
     * @return Prodlib
     */
    public function setPdlItem($pdlItem)
    {
        $this->pdlItem = $pdlItem;

        return $this;
    }

    /**
     * Get pdlItem
     *
     * @return string 
     */
    public function getPdlItem()
    {
        return $this->pdlItem;
    }

    /**
     * Set pdlInfoLib1
     *
     * @param string $pdlInfoLib1
     * @return Prodlib
     */
    public function setPdlInfoLib1($pdlInfoLib1)
    {
        $this->pdlInfoLib1 = $pdlInfoLib1;

        return $this;
    }

    /**
     * Get pdlInfoLib1
     *
     * @return string 
     */
    public function getPdlInfoLib1()
    {
        return $this->pdlInfoLib1;
    }

    /**
     * Set pdlInfoLib2
     *
     * @param string $pdlInfoLib2
     * @return Prodlib
     */
    public function setPdlInfoLib2($pdlInfoLib2)
    {
        $this->pdlInfoLib2 = $pdlInfoLib2;

        return $this;
    }

    /**
     * Get pdlInfoLib2
     *
     * @return string 
     */
    public function getPdlInfoLib2()
    {
        return $this->pdlInfoLib2;
    }

    /**
     * Set pdlInfoLib3
     *
     * @param string $pdlInfoLib3
     * @return Prodlib
     */
    public function setPdlInfoLib3($pdlInfoLib3)
    {
        $this->pdlInfoLib3 = $pdlInfoLib3;

        return $this;
    }

    /**
     * Get pdlInfoLib3
     *
     * @return string 
     */
    public function getPdlInfoLib3()
    {
        return $this->pdlInfoLib3;
    }

    /**
     * Set pdlInfoLib4
     *
     * @param string $pdlInfoLib4
     * @return Prodlib
     */
    public function setPdlInfoLib4($pdlInfoLib4)
    {
        $this->pdlInfoLib4 = $pdlInfoLib4;

        return $this;
    }

    /**
     * Get pdlInfoLib4
     *
     * @return string 
     */
    public function getPdlInfoLib4()
    {
        return $this->pdlInfoLib4;
    }

    /**
     * Set pdlInfoLib5
     *
     * @param string $pdlInfoLib5
     * @return Prodlib
     */
    public function setPdlInfoLib5($pdlInfoLib5)
    {
        $this->pdlInfoLib5 = $pdlInfoLib5;

        return $this;
    }

    /**
     * Get pdlInfoLib5
     *
     * @return string 
     */
    public function getPdlInfoLib5()
    {
        return $this->pdlInfoLib5;
    }

    /**
     * Set pdlInfoLib6
     *
     * @param string $pdlInfoLib6
     * @return Prodlib
     */
    public function setPdlInfoLib6($pdlInfoLib6)
    {
        $this->pdlInfoLib6 = $pdlInfoLib6;

        return $this;
    }

    /**
     * Get pdlInfoLib6
     *
     * @return string 
     */
    public function getPdlInfoLib6()
    {
        return $this->pdlInfoLib6;
    }

    /**
     * Set pdlInfoLib7
     *
     * @param string $pdlInfoLib7
     * @return Prodlib
     */
    public function setPdlInfoLib7($pdlInfoLib7)
    {
        $this->pdlInfoLib7 = $pdlInfoLib7;

        return $this;
    }

    /**
     * Get pdlInfoLib7
     *
     * @return string 
     */
    public function getPdlInfoLib7()
    {
        return $this->pdlInfoLib7;
    }

    /**
     * Set pdlInfoLib8
     *
     * @param string $pdlInfoLib8
     * @return Prodlib
     */
    public function setPdlInfoLib8($pdlInfoLib8)
    {
        $this->pdlInfoLib8 = $pdlInfoLib8;

        return $this;
    }

    /**
     * Get pdlInfoLib8
     *
     * @return string 
     */
    public function getPdlInfoLib8()
    {
        return $this->pdlInfoLib8;
    }

    /**
     * Set pdlInfoLib9
     *
     * @param string $pdlInfoLib9
     * @return Prodlib
     */
    public function setPdlInfoLib9($pdlInfoLib9)
    {
        $this->pdlInfoLib9 = $pdlInfoLib9;

        return $this;
    }

    /**
     * Get pdlInfoLib9
     *
     * @return string 
     */
    public function getPdlInfoLib9()
    {
        return $this->pdlInfoLib9;
    }

    /**
     * Set pdlPckgComm
     *
     * @param string $pdlPckgComm
     * @return Prodlib
     */
    public function setPdlPckgComm($pdlPckgComm)
    {
        $this->pdlPckgComm = $pdlPckgComm;

        return $this;
    }

    /**
     * Get pdlPckgComm
     *
     * @return string 
     */
    public function getPdlPckgComm()
    {
        return $this->pdlPckgComm;
    }

    /**
     * Set pdlDispo
     *
     * @param string $pdlDispo
     * @return Prodlib
     */
    public function setPdlDispo($pdlDispo)
    {
        $this->pdlDispo = $pdlDispo;

        return $this;
    }

    /**
     * Get pdlDispo
     *
     * @return string 
     */
    public function getPdlDispo()
    {
        return $this->pdlDispo;
    }

    /**
     * Set pdlFabDelai
     *
     * @param string $pdlFabDelai
     * @return Prodlib
     */
    public function setPdlFabDelai($pdlFabDelai)
    {
        $this->pdlFabDelai = $pdlFabDelai;

        return $this;
    }

    /**
     * Get pdlFabDelai
     *
     * @return string 
     */
    public function getPdlFabDelai()
    {
        return $this->pdlFabDelai;
    }

    /**
     * Set pdlLivDelai
     *
     * @param string $pdlLivDelai
     * @return Prodlib
     */
    public function setPdlLivDelai($pdlLivDelai)
    {
        $this->pdlLivDelai = $pdlLivDelai;

        return $this;
    }

    /**
     * Get pdlLivDelai
     *
     * @return string 
     */
    public function getPdlLivDelai()
    {
        return $this->pdlLivDelai;
    }
}
