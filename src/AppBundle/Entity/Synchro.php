<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Synchro
 *
 * @ORM\Table(name="synchro")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SynchroRepository")
  *@ORM\HasLifecycleCallbacks()
 */
class Synchro
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255)
    * @ORM\Id
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client",inversedBy="synchros")
      @ORM\JoinColumn(nullable=true)
     * @var User
     */
    protected $user;


    /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\PointVente", mappedBy="synchro", cascade={"persist","remove"})
   *@ORM\OrderBy({"date" = "DESC"})
   */
    private $pointVentes;


    /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rapport", mappedBy="synchro", cascade={"persist","remove"})
   *@ORM\OrderBy({"date" = "DESC"})
   */
    private $rapports;

   /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Quartier", mappedBy="synchro", cascade={"persist","remove"})
   */
    private $quartiers;
        /**
     * Constructor
     */
    public function __construct($user=null, $date=null)
    {
       $this->user=$user;
       $this->date=$date;
       $this->pointVentes = new \Doctrine\Common\Collections\ArrayCollection();
       $this->rapports = new \Doctrine\Common\Collections\ArrayCollection();
       $this->quartiers = new \Doctrine\Common\Collections\ArrayCollection();

    }


    /**
* @ORM\PrePersist
*/
 public function prePersist(){
   foreach ($this->pointVentes as $key => $value) {
      $value->setSynchro($this);
   }

      foreach ($this->rapports as $key => $value) {
      $value->setSynchro($this);
   }

      foreach ($this->quartiers as $key => $value) {
      $value->setSynchro($this);
   }
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
     * Set id
     *
     * @param string $id
     * @return PointVente
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Synchro
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
     * Set status
     *
     * @param string $status
     * @return Synchro
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Client $user
     * @return Synchro
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
     * Add quartiers
     *
     * @param \AppBundle\Entity\Quartier $quartiers
     * @return Secteur
     */
    public function addQuartier(\AppBundle\Entity\Quartier $quartiers)
    {   
        $this->quartiers[] = $quartiers;

        return $this;
    }

   
    /**
     * Remove quartiers
     *
     * @param \AppBundle\Entity\Quartier $quartiers
     */
    public function removeQuartier(\AppBundle\Entity\Quartier $quartiers)
    {
        $this->quartiers->removeElement($quartiers);
    }

    /**
     * Get quartiers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuartiers()
    {
        return $this->quartiers;
    }
  

      /**
     * Add pointVentes
     *
     * @param \AppBundle\Entity\PointVente $pointVentes
     * @return User
     */
    public function addPointVente(\AppBundle\Entity\PointVente $pointVentes)
    {
          $pointVentes->setSynchro($this);
          $this->pointVentes[] =$pointVentes;

        return $this;
    }

     /**
     * Add pointVentes
     *
     * @param \AppBundle\Entity\PointVente $pointVentes
     * @return User
     */
    public function setPointVentes(\Doctrine\Common\Collections\ArrayCollection $pointVentes)
    {
          $this->pointVentes=$pointVentes;

        return $this;
    }

     /**
     * Add quartiers
     *
     * @param \AppBundle\Entity\Quartier $quartiers
     * @return Secteur
     */
    public function setQuartiers(\Doctrine\Common\Collections\ArrayCollection  $quartiers)
    {   
        $this->quartiers= $quartiers;

        return $this;
    }
    /**
     * Remove pointVentes
     *
     * @param \AppBundle\Entity\PointVente $pointVentes
     */
    public function removePointVente(\AppBundle\Entity\PointVente $pointVentes)
    {
        $this->pointVentes->removeElement($pointVentes);
    }

    /**
     * Get pointVentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPointVentes()
    {
        return $this->pointVentes;
    }    

    /**
     * Add rapports
     *
     * @param \AppBundle\Entity\Rapport $rapports
     * @return Synchro
     */
    public function addRapport(\AppBundle\Entity\Rapport $rapports)
    {
  
        $rapports->setSynchro($this);
        $this->rapports[] = $rapports;
        return $this;
    }

    /**
     * Remove rapports
     *
     * @param \AppBundle\Entity\Rapport $rapports
     */
    public function removeRapport(\AppBundle\Entity\Rapport $rapports)
    {
        $this->rapports->removeElement($rapports);
    }

    /**
     * Get rapports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRapports()
    {
        return $this->rapports;
    }
}
