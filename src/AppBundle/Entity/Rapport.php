<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rapport
 *
 * @ORM\Table(name="rapport")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RapportRepository")
   *@ORM\HasLifecycleCallbacks()
 */
class Rapport
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RH")
     * @var User
     */
    protected $rh;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client",inversedBy="rapports")
    * @ORM\JoinColumn(nullable=true)
     */
    protected $user;


    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PointVente",inversedBy="rapports")
   * @ORM\JoinColumn(nullable=false)
   */
  
    private $pointVente;

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=true)
     */
    private $week;

   /**
     * @var string
     *
     * @ORM\Column(name="week_text", type="string", length=255, nullable=true)
     */
    private $weekText;

    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Synchro",inversedBy="rapports")
   *  @ORM\JoinColumn( nullable=true)
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
     * @ORM\Column(name="posRealDay", type="integer")
     */
    private $posRealDay;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreConsomateur", type="integer",nullable=true)
     */
    private $nbreConsomateur;

    /**
     * @var int
     *
     * @ORM\Column(name="etagerLigne", type="integer",nullable=true)
     */
    private $etagerLigne;

    /**
     * @var int
     *
     * @ORM\Column(name="etagerColonne", type="integer",nullable=true)
     */
    private $etagerColonne;

    /**
     * @var int
     *
     * @ORM\Column(name="frigoLigne", type="integer",nullable=true)
     */
    private $frigoLigne;

    /**
     * @var int
     *
     * @ORM\Column(name="frigoColonne", type="integer",nullable=true)
     */
    private $frigoColonne;

    /**
     * @var string
     *
     * @ORM\Column(name="disposition", type="string", length=255, nullable=true)
     */
       private $disposition;

   /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Gagnant", mappedBy="rapport", cascade={"persist","remove"})
   */
    private $gagnants;


      /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $boostrer;

      /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $heineken;

      /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $voodka;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $sabc; 

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $sabc1664; 


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $sminoffRed; 

        /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $sminoffBlue; 


     /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Situation", cascade={"persist","remove"})
     * @ORM\JoinColumn( nullable=true)
     */
    protected $sminoffBlack;




  /**
     * Constructor
     */
    public function __construct()
    {
        $this->gagnants = new \Doctrine\Common\Collections\ArrayCollection();
    }
/**
* @ORM\PrePersist
*/
 public function prePersist(){
     $this->week =$this->date->format("W");
     $year=$this->date->format("Y");
    $date = new \DateTime();
    $date->setISODate($year, $this->week);
    $startDate=$date->format('d/m');
    $date->modify('+6 days');
    $endDate=$date->format('d/m');
    $this->weekText=$startDate.' - '.$endDate;
  }

      /**
     * Get week
     *
     * @return integer 
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Set weekText
     *
     * @param string $weekText
     * @return Visite
     */
    public function setWeekText($weekText)
    {
        $this->weekText = $weekText;

        return $this;
    }

    /**
     * Get weekText
     *
     * @return string 
     */
    public function getWeekText()
    {
        return $this->weekText;
    }
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
     * Set fi
     *
     * @param integer $fi
     * @return Rapport
     */
    public function setFi($fi)
    {
        $this->fi = $fi;

        return $this;
    }

    /**
     * Get fi
     *
     * @return integer 
     */
    public function getFi()
    {
        return $this->fi;
    }

    /**
     * Set boostrer
     *
     * @param \AppBundle\Entity\Situation $boostrer
     * @return Rapport
     */
    public function setBoostrer(\AppBundle\Entity\Situation $boostrer = null)
    {
        $boostrer->setRapport($this);
        $this->boostrer = $boostrer;

        return $this;
    }

    /**
     * Get boostrer
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getBoostrer()
    {
        return $this->boostrer;
    }

    /**
     * Set heineken
     *
     * @param \AppBundle\Entity\Situation $heineken
     * @return Rapport
     */
    public function setHeineken(\AppBundle\Entity\Situation $heineken = null)
    {
        $heineken->setRapport($this);
        $this->heineken = $heineken;

        return $this;
    }

    /**
     * Get heineken
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getHeineken()
    {
        return $this->heineken;
    }

    /**
     * Set voodka
     *
     * @param \AppBundle\Entity\Situation $voodka
     * @return Rapport
     */
    public function setVoodka(\AppBundle\Entity\Situation $voodka = null)
    {
         $voodka->setRapport($this);
        $this->voodka = $voodka;

        return $this;
    }

    /**
     * Get voodka
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getVoodka()
    {
        return $this->voodka;
    }

    /**
     * Set sabc
     *
     * @param \AppBundle\Entity\Situation $sabc
     * @return Rapport
     */
    public function setSabc(\AppBundle\Entity\Situation $sabc = null)
    {
         $sabc->setRapport($this);
        $this->sabc = $sabc;

        return $this;
    }

    /**
     * Get sabc
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getSabc()
    {
        return $this->sabc;
    }

    /**
     * Set sabc1664
     *
     * @param \AppBundle\Entity\Situation $sabc1664
     * @return Rapport
     */
    public function setSabc1664(\AppBundle\Entity\Situation $sabc1664 = null)
    {
          $sabc1664->setRapport($this);
        $this->sabc1664 = $sabc1664;

        return $this;
    }

    /**
     * Get sabc1664
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getSabc1664()
    {
        return $this->sabc1664;
    }

    /**
     * Set sminoffRed
     *
     * @param \AppBundle\Entity\Situation $sminoffRed
     * @return Rapport
     */
    public function setSminoffRed(\AppBundle\Entity\Situation $sminoffRed = null)
    {    $sminoffRed->setRapport($this);
        $this->sminoffRed = $sminoffRed;

        return $this;
    }

    /**
     * Get sminoffRed
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getSminoffRed()
    {
        return $this->sminoffRed;
    }

    /**
     * Set sminoffBlue
     *
     * @param \AppBundle\Entity\Situation $sminoffBlue
     * @return Rapport
     */
    public function setSminoffBlue(\AppBundle\Entity\Situation $sminoffBlue = null)
    {
        $sminoffBlue->setRapport($this);
        $this->sminoffBlue = $sminoffBlue;

        return $this;
    }

    /**
     * Get sminoffBlue
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getSminoffBlue()
    {
        return $this->sminoffBlue;
    }

    /**
     * Set sminoffBlack
     *
     * @param \AppBundle\Entity\Situation $sminoffBlack
     * @return Rapport
     */
    public function setSminoffBlack(\AppBundle\Entity\Situation $sminoffBlack = null)
    {
        $sminoffBlack->setRapport($this);
        $this->sminoffBlack = $sminoffBlack;
 
        return $this;
    }

    /**
     * Get sminoffBlack
     *
     * @return \AppBundle\Entity\Situation 
     */
    public function getSminoffBlack()
    {
        return $this->sminoffBlack;
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
     * Add gagnants
     *
     * @param \AppBundle\Entity\Gagnant $gagnants
     * @return Rapport
     */
    public function addGagnant(\AppBundle\Entity\Gagnant $gagnants)
    {
        $gagnants->setRapport($this);
        $this->gagnants[] = $gagnants;

        return $this;
    }

    /**
     * Remove gagnants
     *
     * @param \AppBundle\Entity\Gagnant $gagnants
     */
    public function removeGagnant(\AppBundle\Entity\Gagnant $gagnants)
    {
        $this->gagnants->removeElement($gagnants);
    }

    /**
     * Get gagnants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGagnants()
    {
        return $this->gagnants;
    }

    /**
     * Set rh
     *
     * @param \AppBundle\Entity\RH $rh
     * @return Rapport
     */
    public function setRh(\AppBundle\Entity\RH $rh = null)
    {
        $this->rh = $rh;

        return $this;
    }

    /**
     * Get rh
     *
     * @return \AppBundle\Entity\RH 
     */
    public function getRh()
    {
        return $this->rh;
    }

     /**
     * Set etagerLigne
     *
     * @param integer $etagerLigne
     * @return Merchandising
     */
    public function setEtagerLigne($etagerLigne)
    {
        $this->etagerLigne = $etagerLigne;

        return $this;
    }

    /**
     * Get etagerLigne
     *
     * @return integer 
     */
    public function getEtagerLigne()
    {
        return $this->etagerLigne;
    }

    /**
     * Set etagerColonne
     *
     * @param integer $etagerColonne
     * @return Merchandising
     */
    public function setEtagerColonne($etagerColonne)
    {
        $this->etagerColonne = $etagerColonne;

        return $this;
    }

    /**
     * Get etagerColonne
     *
     * @return integer 
     */
    public function getEtagerColonne()
    {
        return $this->etagerColonne;
    }

    /**
     * Set frigoLigne
     *
     * @param integer $frigoLigne
     * @return Merchandising
     */
    public function setFrigoLigne($frigoLigne)
    {
        $this->frigoLigne = $frigoLigne;

        return $this;
    }

    /**
     * Get frigoLigne
     *
     * @return integer 
     */
    public function getFrigoLigne()
    {
        return $this->frigoLigne;
    }

    /**
     * Set frigoColonne
     *
     * @param integer $frigoColonne
     * @return Merchandising
     */
    public function setFrigoColonne($frigoColonne)
    {
        $this->frigoColonne = $frigoColonne;

        return $this;
    }

    /**
     * Get frigoColonne
     *
     * @return integer 
     */
    public function getFrigoColonne()
    {
        return $this->frigoColonne;
    }

    /**
     * Set disposition
     *
     * @param string $disposition
     * @return Merchandising
     */
    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;

        return $this;
    }

    /**
     * Get disposition
     *
     * @return string 
     */
    public function getDisposition()
    {
        return $this->disposition;
    }
}
