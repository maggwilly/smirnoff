<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stituation
 *
 * @ORM\Table(name="situation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SituationRepository")
 */
class Situation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="frigo", type="boolean", nullable=true)
     */
    private $frigo;
    
    /**
     * @var string
     * @ORM\Column(name="marque", type="string", length=255, nullable=true)
     */
    private $marque;
    /**
     * @var bool
     *
     * @ORM\Column(name="affiche", type="boolean", nullable=true)
     */
    private $affiche;

    /**
     * @var bool
     *
     * @ORM\Column(name="autre", type="boolean", nullable=true)
     */
    private $autre;
    /**
     * @var bool
     *
     * @ORM\Column(name="affichette", type="boolean", nullable=true)
     */
    private $affichette;


  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rapport")
   * @ORM\JoinColumn( nullable=true, onDelete="SET NULL")
   */
    private $rapport;

    /**
     * @var bool
     *
     * @ORM\Column(name="potence", type="boolean", nullable=true)
     */
    private $potence;

    /**
     * @var bool
     *
     * @ORM\Column(name="ncp", type="boolean", nullable=true)
     */
    private $ncp;

        /**
     * @var bool
     *
     * @ORM\Column(name="tcp", type="boolean", nullable=true)
     */
    private $tcp;

    /**
     * @var bool
     *
     * @ORM\Column(name="inbar", type="boolean", nullable=true)
     */
    private $inbar;


     /**
     * @var bool
     *
     * @ORM\Column(name="absent", type="boolean", nullable=true)
     */
    private $absent;

    /**
     * @var bool
     *
     * @ORM\Column(name="enrupture", type="boolean", nullable=true)
     */
    private $enrupture;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreRh", type="integer", nullable=true)
     */
    private $nbreRh;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="bnreBlle", type="integer", nullable=true)
     */
    private $bnreBlle;


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
     * Set frigo
     *
     * @param boolean $frigo
     * @return Stituation
     */
    public function setFrigo($frigo)
    { if($frigo)
        $this->frigo = $frigo;

        return $this;
    }

    /**
     * Get frigo
     *
     * @return boolean 
     */
    public function getFrigo()
    {
        return $this->frigo;
    }

    /**
     * Set affiche
     *
     * @param boolean $affiche
     * @return Stituation
     */
    public function setAffiche($affiche)
    {
        if($affiche)
        $this->affiche = $affiche;

        return $this;
    }

    /**
     * Get affiche
     *
     * @return boolean 
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * Set potence
     *
     * @param boolean $potence
     * @return Stituation
     */
    public function setPotence($potence)
    {
        if($potence)
        $this->potence = $potence;

        return $this;
    }

    /**
     * Get potence
     *
     * @return boolean 
     */
    public function getPotence()
    {
        return $this->potence;
    }

    /**
     * Set ncp
     *
     * @param boolean $ncp
     * @return Stituation
     */
    public function setNcp($ncp)
    {
        if($ncp)
        $this->ncp = $ncp;

        return $this;
    }

    /**
     * Get ncp
     *
     * @return boolean 
     */
    public function getNcp()
    {
        return $this->ncp;
    }
    /**
     * Set ncp
     *
     * @param boolean $ncp
     * @return Stituation
     */
    public function setTcp($ncp)
    {
         if($ncp)
        $this->tcp = $ncp;

        return $this;
    }

    /**
     * Get ncp
     *
     * @return boolean 
     */
    public function getTcp()
    {
        return $this->tcp;
    }
    /**
     * Set inbar
     *
     * @param boolean $inbar
     * @return Stituation
     */
    public function setInbar($inbar)
    {
         if($inbar)
        $this->inbar = $inbar;

        return $this;
    }

    /**
     * Get inbar
     *
     * @return boolean 
     */
    public function getInbar()
    {
        return $this->inbar;
    }

    /**
     * Set nbreRh
     *
     * @param integer $nbreRh
     * @return Stituation
     */
    public function setNbreRh($nbreRh)
    {
          if($inbar)
        $this->nbreRh = $nbreRh;

        return $this;
    }

    /**
     * Get nbreRh
     *
     * @return integer 
     */
    public function getNbreRh()
    {
        return $this->nbreRh;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Stituation
     */
    public function setPrice($price)
    {  if(!$this->absent && !$this->enrupture)
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set bnreBlle
     *
     * @param integer $bnreBlle
     * @return Stituation
     */
    public function setBnreBlle($bnreBlle)
    {
         if(!$this->absent && !$this->enrupture)
        $this->bnreBlle = $bnreBlle;

        return $this;
    }

    /**
     * Get bnreBlle
     *
     * @return integer 
     */
    public function getBnreBlle()
    {
        return $this->bnreBlle;
    }

    /**
     * Set marque
     *
     * @param string $marque
     * @return Situation
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set rapport
     *
     * @param \AppBundle\Entity\Rapport $rapport
     * @return Situation
     */
    public function setRapport(\AppBundle\Entity\Rapport $rapport = null)
    {
        $this->rapport = $rapport;

        return $this;
    }

    /**
     * Get rapport
     *
     * @return \AppBundle\Entity\Rapport 
     */
    public function getRapport()
    {
        return $this->rapport;
    }

    /**
     * Set autre
     *
     * @param boolean $autre
     * @return Situation
     */
    public function setAutre($autre)
    {
         if($autre)
        $this->autre = $autre;

        return $this;
    }

    /**
     * Get autre
     *
     * @return boolean 
     */
    public function getAutre()
    {
        return $this->autre;
    }

    /**
     * Set affichette
     *
     * @param boolean $affichette
     * @return Situation
     */
    public function setAffichette($affichette)
    { if($affichette)
        $this->affichette = $affichette;

        return $this;
    }

    /**
     * Get affichette
     *
     * @return boolean 
     */
    public function getAffichette()
    {
        return $this->affichette;
    }

    /**
     * Set absent
     *
     * @param boolean $absent
     * @return Situation
     */
    public function setAbsent($absent)
    {
        
       if($absent) 
    
        $this->absent = $absent;

        return $this;
    }

    /**
     * Get absent
     *
     * @return boolean 
     */
    public function getAbsent()
    {
        return $this->absent;
    }

    /**
     * Set enrupture
     *
     * @param boolean $enrupture
     * @return Situation
     */
    public function setEnrupture($enrupture)
    {
         if($enrupture) 
        $this->enrupture = $enrupture;

        return $this;
    }

    /**
     * Get enrupture
     *
     * @return boolean 
     */
    public function getEnrupture()
    {
        return $this->enrupture;
    }
}
