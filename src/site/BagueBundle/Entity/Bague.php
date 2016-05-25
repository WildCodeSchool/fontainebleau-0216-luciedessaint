<?php

namespace site\BagueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bague
 */
class Bague
{
// A la mano

    // Upload image
    public $file;
    protected function getUploadDir()
    {
        return '/uploads/img/bague/';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->photo ? null : $this->getUploadDir().'/'.$this->photo;
    }

    public function getAbsolutePath()
    {
        return null === $this->photo ? null : $this->getUploadRootDir().'/'.$this->photo;
    }
    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->photo = uniqid().'.'.$this->file->guessExtension();
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
        if (null === $this->file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->photo);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

// Generate code
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prixttc;

    /**
     * @var array
     */
    private $taille;

    /**
     * @var string
     */
    private $metaux;

    /**
     * @var array
     */
    private $sexe;

    /**
     * @var array
     */
    private $garantie;

    /**
     * @var string
     */
    private $largeur;

    /**
     * @var string
     */
    private $photo;


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
     * Set nom
     *
     * @param string $nom
     * @return Bague
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prixttc
     *
     * @param string $prixttc
     * @return Bague
     */
    public function setPrixttc($prixttc)
    {
        $this->prixttc = $prixttc;

        return $this;
    }

    /**
     * Get prixttc
     *
     * @return string 
     */
    public function getPrixttc()
    {
        return $this->prixttc;
    }

    /**
     * Set taille
     *
     * @param array $taille
     * @return Bague
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return array 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set metaux
     *
     * @param string $metaux
     * @return Bague
     */
    public function setMetaux($metaux)
    {
        $this->metaux = $metaux;

        return $this;
    }

    /**
     * Get metaux
     *
     * @return string 
     */
    public function getMetaux()
    {
        return $this->metaux;
    }

    /**
     * Set sexe
     *
     * @param array $sexe
     * @return Bague
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return array 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set garantie
     *
     * @param array $garantie
     * @return Bague
     */
    public function setGarantie($garantie)
    {
        $this->garantie = $garantie;

        return $this;
    }

    /**
     * Get garantie
     *
     * @return array 
     */
    public function getGarantie()
    {
        return $this->garantie;
    }

    /**
     * Set largeur
     *
     * @param string $largeur
     * @return Bague
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * Get largeur
     *
     * @return string 
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Bague
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * @var string
     */
    private $reference;


    /**
     * Set reference
     *
     * @param string $reference
     * @return Bague
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }
}
