<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * PointVente
 *
 * @ORM\Table(name="point_vente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PointVenteRepository")
 *@ORM\HasLifecycleCallbacks()
 */
class PointVente
{
    /**
     * @var string
     *
     * @ORM\Column(name="id",  type="string", length=255)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255,  nullable=true)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="nomGerant", type="string", length=255, nullable=true)
     */
    private $nomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="telGerant", type="string", length=255, nullable=true)
     */
    private $telGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="quartier", type="string", length=255, nullable=true)
     */
    private $quartier;


    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=255, nullable=true)
     */
    private $matricule;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client")
     * @ORM\JoinColumn(nullable=true,  referencedColumnName="id")
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

      /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt;

  
   /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rapport", mappedBy="pointVente", cascade={"persist","remove"})
   *@ORM\OrderBy({"date" = "DESC"})
   */
    private $rapports;
    
    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Synchro",inversedBy="pointVentes")
   * 
   */
    private $synchro;

    /**
     * Constructor
     */
    public function __construct($user=null,$nom=null,$id=null, $type=null,$longitude=null, $latitude=null,$description=null,$createdAt=null,$nomGerant=null,$ville=null)
    {
       $this->user=$user;
      $this->nom=$nom;
      $this->date=new \DateTime();
      $this->id=$id;
      $this->type=$type;
      $this->longitude=$longitude;
      $this->latitude=$latitude;
      $this->description=$description;
      $this->createdAt=$createdAt;
      $this->nomGerant=$nomGerant;
      $this->ville=$ville;
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     * @param string $nom
     * @return PointVente
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
     * Set nomGerant
     *
     * @param string $nomGerant
     * @return PointVente
     */
    public function setNomGerant($nomGerant)
    {
        $this->nomGerant = $nomGerant;

        return $this;
    }

    /**
     * Get nomGerant
     *
     * @return string 
     */
    public function getNomGerant()
    {
        return $this->nomGerant;
    }
    /**
     * Set type
     *
     * @param string $type
     * @return Etape
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Set telGerant
     *
     * @param string $telGerant
     * @return PointVente
     */
    public function setTelGerant($telGerant)
    {
        $this->telGerant = $telGerant;

        return $this;
    }

    /**
     * Get telGerant
     *
     * @return string 
     */
    public function getTelGerant()
    {
        return $this->telGerant;
    }
    /**
     * Get telGerant
     *
     * @return string 
     */
    public function getMatricule()
    {
        return $this->matricule;
    }
    /**
     * Set tel
     *
     * @param string $tel
     * @return PointVente
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return PointVente
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return PointVente
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return PointVente
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set quartier
     *
     * @param string $quartier
     * @return PointVente
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get quartier
     *
     * @return string 
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PointVente
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return PointVente
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return PointVente
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
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
     * @return PointVente
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
     * @param \AppBundle\Entity\User $user
     * @return PointVente
     */
    public function setUser(\AppBundle\Entity\Client $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PointVente
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
  /**
  * @ORM\PrePersist
 */
 public function prePersist(){
 
    

 }
    /**
     * Set synchro
     * @param \AppBundle\Entity\Synchro $synchro
     * @return PointVente
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
     * Set matricule
     *
     * @param string $matricule
     * @return PointVente
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Add rapports
     *
     * @param \AppBundle\Entity\Rapport $rapports
     * @return PointVente
     */
    public function addRapport(\AppBundle\Entity\Rapport $rapports)
    {
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
