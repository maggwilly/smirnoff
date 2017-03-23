<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rapport
 * @ORM\Table(name="rapport1")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RapportRepository")
 */
class Rapport1
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;




    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client",inversedBy="rapports")
     * @var User
     */
    protected $user;


    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PointVente",inversedBy="rapports")
   * @ORM\JoinColumn(nullable=false)
   */
  
    private $pointVente;


    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Synchro",inversedBy="rapports")
   * 
   */
    private $synchro;
    
   /**
     * @var int
     *
     * @ORM\Column(name="posTarget", type="integer")
     */
    private $posTarget;

    /**
     * @var int
     *
     * @ORM\Column(name="posRealTarget", type="integer")
     */
    private $posRealTarget;

    /**
     * @var int
     *
     * @ORM\Column(name="posRealDay", type="integer")
     */
    private $posRealDay;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreConsomateur", type="integer")
     */
    private $nbreConsomateur;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreProduitCon", type="integer")
     */
    private $nbreProduitCon;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreProduitGuiness", type="integer")
     */
    private $nbreProduitGuiness;

    /**
     * @var string
     *
     * @ORM\Column(name="nbreProduitSminoff", type="integer")
     */
    private $nbreProduitSminoff;


    /**
     * @var string
     *
     * @ORM\Column(name="nbreSminoffBlack", type="integer")
     */
    private $nbreSminoffBlack;

    /**
     * @var string
     *
     * @ORM\Column(name="nbreSminoffBlue", type="integer")
     */
    private $nbreSminoffBlue;

    /**
     * @var string
     *
     * @ORM\Column(name="nbreSminoffRed", type="integer")
     */
    private $nbreSminoffRed;

 /**
     * @var bool
     *
     * @ORM\Column(name="el1", type="boolean")
     */
    private $el1;

    /**
     * @var bool
     *
     * @ORM\Column(name="el2", type="boolean")
     */
    private $el2;

    /**
     * @var bool
     *
     * @ORM\Column(name="el3", type="boolean")
     */
    private $el3;

    /**
     * @var bool
     *
     * @ORM\Column(name="el4", type="boolean")
     */
    private $el4;


    /**
     * @var bool
     *
     * @ORM\Column(name="sminoffBlue", type="boolean")
     */
    private $sminoffBlue;

    /**
     * @var bool
     *
     * @ORM\Column(name="sminoffBlack", type="boolean")
     */
    private $sminoffBlack;

    /**
     * @var bool
     *
     * @ORM\Column(name="sminoffRed", type="boolean")
     */
    private $sminoffRed;
  /**
     * @var int
     *
     * @ORM\Column(name="r1", type="integer")
     */
    private $r1;

    /**
     * @var int
     *
     * @ORM\Column(name="r2", type="integer")
     */
    private $r2;

    /**
     * @var int
     *
     * @ORM\Column(name="r3", type="integer")
     */
    private $r3;

    /**
     * @var int
     *
     * @ORM\Column(name="r4", type="integer")
     */
    private $r4;

        /**
     * @var int
     *
     * @ORM\Column(name="r5", type="integer")
     */
    private $r5;

    /**
     * @var int
     *
     * @ORM\Column(name="r6", type="integer")
     */
    private $r6;

    /**
     * @var int
     *
     * @ORM\Column(name="r7", type="integer")
     */
    private $r7;

    /**
     * @var int
     *
     * @ORM\Column(name="r8", type="integer")
     */
    private $r8;

        /**
     * @var int
     *
     * @ORM\Column(name="r9", type="integer")
     */
    private $r9;
        /**
     * @var int
     *
     * @ORM\Column(name="boostrerCola", type="integer")
     */
    protected $boostrerCola;

        /**
     * @var int
     *
     * @ORM\Column(name="boostrerCider", type="integer")
     */
    protected $boostrerCider;
   /**
     * @var int
     *
     * @ORM\Column(name="heineken", type="integer")
     */
 
    protected $heineken;

   /**
     * @var int
     *
     * @ORM\Column(name="voodka", type="integer")
     */
 
    protected $voodka; 

   /**
     * @var int
     *
     * @ORM\Column(name="biere", type="integer")
     */
    protected $biere; 


    /**
     * @var int
     *
     * @ORM\Column(name="nbreproduitpromo", type="integer")
     */
    private $nbreProduitPromo;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreRh", type="integer")
     */
    private $nbreRh;

        /**
     * @var string
     *
     * @ORM\Column(name="produitEnPromo", type="string", length=255)
     */
    private $produitEnPromo;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Rapport
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }



    /**
     * Set user
     *
     * @param \AppBundle\Entity\Client $user
     * @return Rapport
     */
    public function setUser(\AppBundle\Entity\Client $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Client 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set synchro
     *
     * @param \AppBundle\Entity\Synchro $synchro
     * @return Rapport
     */
    public function setSynchro(\AppBundle\Entity\Synchro $synchro = null)
    {
        $this->synchro = $synchro;

        return $this;
    }

    /**
     * Get synchro
     *
     * @return \AppBundle\Entity\Synchro 
     */
    public function getSynchro()
    {
        return $this->synchro;
    }


    /**
     * Get sale
     *
     * @return \AppBundle\Entity\Sale 
     */
    public function getSale()
    {
        return $this->sale;
    }

   
    /**
     * Set pointVente
     *
     * @param \AppBundle\Entity\PointVente $pointVente
     * @return Rapport
     */
    public function setPointVente(\AppBundle\Entity\PointVente $pointVente)
    {
        $this->pointVente = $pointVente;

        return $this;
    }

    /**
     * Get pointVente
     *
     * @return \AppBundle\Entity\PointVente 
     */
    public function getPointVente()
    {
        return $this->pointVente;
    }

    /**
     * Set posTarget
     *
     * @param integer $posTarget
     * @return Rapport
     */
    public function setPosTarget($posTarget)
    {
        $this->posTarget = $posTarget;

        return $this;
    }

    /**
     * Get posTarget
     *
     * @return integer 
     */
    public function getPosTarget()
    {
        return $this->posTarget;
    }

    /**
     * Set posRealTarget
     *
     * @param integer $posRealTarget
     * @return Rapport
     */
    public function setPosRealTarget($posRealTarget)
    {
        $this->posRealTarget = $posRealTarget;

        return $this;
    }

    /**
     * Get posRealTarget
     *
     * @return integer 
     */
    public function getPosRealTarget()
    {
        return $this->posRealTarget;
    }

    /**
     * Set posRealDay
     *
     * @param integer $posRealDay
     * @return Rapport
     */
    public function setPosRealDay($posRealDay)
    {
        $this->posRealDay = $posRealDay;

        return $this;
    }

    /**
     * Get posRealDay
     *
     * @return integer 
     */
    public function getPosRealDay()
    {
        return $this->posRealDay;
    }

    /**
     * Set nbreConsomateur
     *
     * @param integer $nbreConsomateur
     * @return Rapport
     */
    public function setNbreConsomateur($nbreConsomateur)
    {
        $this->nbreConsomateur = $nbreConsomateur;

        return $this;
    }

    /**
     * Get nbreConsomateur
     *
     * @return integer 
     */
    public function getNbreConsomateur()
    {
        return $this->nbreConsomateur;
    }

    /**
     * Set nbreProduitCon
     *
     * @param integer $nbreProduitCon
     * @return Rapport
     */
    public function setNbreProduitCon($nbreProduitCon)
    {
        $this->nbreProduitCon = $nbreProduitCon;

        return $this;
    }

    /**
     * Get nbreProduitCon
     *
     * @return integer 
     */
    public function getNbreProduitCon()
    {
        return $this->nbreProduitCon;
    }

    /**
     * Set nbreProduitGuiness
     *
     * @param integer $nbreProduitGuiness
     * @return Rapport
     */
    public function setNbreProduitGuiness($nbreProduitGuiness)
    {
        $this->nbreProduitGuiness = $nbreProduitGuiness;

        return $this;
    }

    /**
     * Get nbreProduitGuiness
     *
     * @return integer 
     */
    public function getNbreProduitGuiness()
    {
        return $this->nbreProduitGuiness;
    }

    /**
     * Set nbreProduitSminoff
     *
     * @param integer $nbreProduitSminoff
     * @return Rapport
     */
    public function setNbreProduitSminoff($nbreProduitSminoff)
    {
        $this->nbreProduitSminoff = $nbreProduitSminoff;

        return $this;
    }

    /**
     * Get nbreProduitSminoff
     *
     * @return integer 
     */
    public function getNbreProduitSminoff()
    {
        return $this->nbreProduitSminoff;
    }

    /**
     * Set el1
     *
     * @param boolean $el1
     * @return Rapport
     */
    public function setEl1($el1)
    {
        $this->el1 = $el1;

        return $this;
    }

    /**
     * Get el1
     *
     * @return boolean 
     */
    public function getEl1()
    {
        return $this->el1;
    }

    /**
     * Set el2
     *
     * @param boolean $el2
     * @return Rapport
     */
    public function setEl2($el2)
    {
        $this->el2 = $el2;

        return $this;
    }

    /**
     * Get el2
     *
     * @return boolean 
     */
    public function getEl2()
    {
        return $this->el2;
    }

    /**
     * Set el3
     *
     * @param boolean $el3
     * @return Rapport
     */
    public function setEl3($el3)
    {
        $this->el3 = $el3;

        return $this;
    }

    /**
     * Get el3
     *
     * @return boolean 
     */
    public function getEl3()
    {
        return $this->el3;
    }

    /**
     * Set el4
     *
     * @param boolean $el4
     * @return Rapport
     */
    public function setEl4($el4)
    {
        $this->el4 = $el4;

        return $this;
    }

    /**
     * Get el4
     *
     * @return boolean 
     */
    public function getEl4()
    {
        return $this->el4;
    }

    /**
     * Set sminoffBlue
     *
     * @param boolean $sminoffBlue
     * @return Rapport
     */
    public function setSminoffBlue($sminoffBlue)
    {
        $this->sminoffBlue = $sminoffBlue;

        return $this;
    }

    /**
     * Get sminoffBlue
     *
     * @return boolean 
     */
    public function getSminoffBlue()
    {
        return $this->sminoffBlue;
    }

    /**
     * Set sminoffBlack
     *
     * @param boolean $sminoffBlack
     * @return Rapport
     */
    public function setSminoffBlack($sminoffBlack)
    {
        $this->sminoffBlack = $sminoffBlack;

        return $this;
    }

    /**
     * Get sminoffBlack
     *
     * @return boolean 
     */
    public function getSminoffBlack()
    {
        return $this->sminoffBlack;
    }

    /**
     * Set r1
     *
     * @param integer $r1
     * @return Rapport
     */
    public function setR1($r1)
    {
        $this->r1 = $r1;

        return $this;
    }

    /**
     * Get r1
     *
     * @return integer 
     */
    public function getR1()
    {
        return $this->r1;
    }

    /**
     * Set r2
     *
     * @param integer $r2
     * @return Rapport
     */
    public function setR2($r2)
    {
        $this->r2 = $r2;

        return $this;
    }

    /**
     * Get r2
     *
     * @return integer 
     */
    public function getR2()
    {
        return $this->r2;
    }

    /**
     * Set r3
     *
     * @param integer $r3
     * @return Rapport
     */
    public function setR3($r3)
    {
        $this->r3 = $r3;

        return $this;
    }

    /**
     * Get r3
     *
     * @return integer 
     */
    public function getR3()
    {
        return $this->r3;
    }

    /**
     * Set r4
     *
     * @param integer $r4
     * @return Rapport
     */
    public function setR4($r4)
    {
        $this->r4 = $r4;

        return $this;
    }

    /**
     * Get r4
     *
     * @return integer 
     */
    public function getR4()
    {
        return $this->r4;
    }

    /**
     * Set r5
     *
     * @param integer $r5
     * @return Rapport
     */
    public function setR5($r5)
    {
        $this->r5 = $r5;

        return $this;
    }

    /**
     * Get r5
     *
     * @return integer 
     */
    public function getR5()
    {
        return $this->r5;
    }



    /**
     * Set boostrer
     *
     * @param integer $boostrer
     * @return Rapport
     */
    public function setBoostrer($boostrer)
    {
        $this->boostrer = $boostrer;

        return $this;
    }

    /**
     * Get boostrer
     *
     * @return integer 
     */
    public function getBoostrer()
    {
        return $this->boostrer;
    }

    /**
     * Set heineken
     *
     * @param integer $heineken
     * @return Rapport
     */
    public function setHeineken($heineken)
    {
        $this->heineken = $heineken;

        return $this;
    }

    /**
     * Get heineken
     *
     * @return integer 
     */
    public function getHeineken()
    {
        return $this->heineken;
    }

    /**
     * Set voodka
     *
     * @param integer $voodka
     * @return Rapport
     */
    public function setVoodka($voodka)
    {
        $this->voodka = $voodka;

        return $this;
    }

    /**
     * Get voodka
     *
     * @return integer 
     */
    public function getVoodka()
    {
        return $this->voodka;
    }

    /**
     * Set biere
     *
     * @param integer $biere
     * @return Rapport
     */
    public function setBiere($biere)
    {
        $this->biere = $biere;

        return $this;
    }

    /**
     * Get biere
     *
     * @return integer 
     */
    public function getBiere()
    {
        return $this->biere;
    }

    /**
     * Set nbreProduitPromo
     *
     * @param integer $nbreProduitPromo
     * @return Rapport
     */
    public function setNbreProduitPromo($nbreProduitPromo)
    {
        $this->nbreProduitPromo = $nbreProduitPromo;

        return $this;
    }

    /**
     * Get nbreProduitPromo
     *
     * @return integer 
     */
    public function getNbreProduitPromo()
    {
        return $this->nbreProduitPromo;
    }

    /**
     * Set nbreRh
     *
     * @param integer $nbreRh
     * @return Rapport
     */
    public function setNbreRh($nbreRh)
    {
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
     * Set produitEnPromo
     *
     * @param string $produitEnPromo
     * @return Rapport
     */
    public function setProduitEnPromo($produitEnPromo)
    {
        $this->produitEnPromo = $produitEnPromo;

        return $this;
    }

    /**
     * Get produitEnPromo
     * @return string 
     */
    public function getProduitEnPromo()
    {
        return $this->produitEnPromo;
    }
}
