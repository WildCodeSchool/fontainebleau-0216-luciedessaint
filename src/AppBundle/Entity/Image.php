<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 */
class Image
{
    // Code écrit

    public $phImage;

    protected function getUploadDir()
    {
        return 'uploads/aleatoire';
    }
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    public function getWebPath_PhImage()
    {
        return null === $this->imgTitre ? null : $this->getUploadDir().'/'.$this->imgTitre;
    }
    public function getAbsolutePath_PhImage()
    {
        return null === $this->imgTitre ? null : $this->getUploadRootDir().'/'.$this->imgTitre;
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->phImage) {
            // do whatever you want to generate a unique name
            $cat = $this->imgCat;
            var_dump($cat);
            $this->imgTitre = $cat."_".uniqid().'.'.$this->phImage->guessExtension();
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
        // Add your code here
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null !== $this->phImage) {
            $this->phImage->move($this->getUploadRootDir(), $this->imgTitre);
            unset($this->phImage);
        }
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($phImage = $this->getAbsolutePath_PhImage()) {
            unlink($phImage);
        }
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
    private $imgTitre;

    /**
     * @var string
     */
    private $imgCat;


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
     * Set imgTitre
     *
     * @param string $imgTitre
     * @return Image
     */
    public function setImgTitre($imgTitre)
    {
        $this->imgTitre = $imgTitre;

        return $this;
    }

    /**
     * Get imgTitre
     *
     * @return string 
     */
    public function getImgTitre()
    {
        return $this->imgTitre;
    }

    /**
     * Set imgCat
     *
     * @param string $imgCat
     * @return Image
     */
    public function setImgCat($imgCat)
    {
        $this->imgCat = $imgCat;

        return $this;
    }

    /**
     * Get imgCat
     *
     * @return string 
     */
    public function getImgCat()
    {
        return $this->imgCat;
    }
}
