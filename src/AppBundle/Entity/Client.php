<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * /**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
  *@ORM\HasLifecycleCallbacks()
 */
class Client extends BaseUser
{
    
    /**
     * @var string
     * @ORM\Column(name="id",  type="string", length=255)
     * @ORM\Id
     */
    protected $id;
	
    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
    private $nom;

   /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=255,nullable=true)
     */
    private $ville;
  /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255,nullable=true,  options={"default" :"super"})
     */
    private $type;
     /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255,unique=true)
     */
    protected $username;

        /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    protected $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;


   /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rapport", mappedBy="user", cascade={"persist","remove"})
   *@ORM\OrderBy({"date" = "DESC"})
   */
    private $rapports;

   /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Synchro", mappedBy="user", cascade={"persist","remove"})
   *@ORM\OrderBy({"date" = "DESC"})
   */
    private $synchros;


 
     /**
     * @var string
     *
     * @ORM\Column(name="usernameCanonical", type="string", length=180, unique=true, nullable=false)
     */
    protected $usernameCanonical;

   /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCanonical", type="string", length=180, unique=true)
     */
    protected $emailCanonical;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean",nullable=true)
     */
    protected $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string")
     */
    protected $salt;


   /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastLogin", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmationToken", type="string", length=180,unique=true ,nullable=true)
     */
    protected $confirmationToken;

   /**
     * @var \DateTime
     *
     * @ORM\Column(name="passwordRequestedAt", type="datetime" , nullable=true)
     */
    protected $passwordRequestedAt;


    /**
     * @var bool
     *
     * @ORM\Column(name="locked", type="boolean",nullable=true)
     */
    protected $locked;

    /**
     * @var bool
     *
     * @ORM\Column(name="expired", type="boolean",nullable=true)
     */
    protected $expired;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiresAt", type="datetime",nullable=true)
     */
    protected $expiresAt;


   
     /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    protected $roles;

     /**
     * @var bool
     *
     * @ORM\Column(name="credentialsExpired", type="boolean",nullable=true)
     */
    protected $credentialsExpired;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="credentialsExpireAt", type="datetime",nullable=true)
     */
    protected $credentialsExpireAt;


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
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Client
     */
    public function setId($username)
    {
        $this->id = $username;
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
  * @ORM\PrePersist
 */
 public function prePersist(){
 
    $this->id = $this->username;
 } 
  
    /**
     * Constructor
     */
 
 public function __construct()
    {
        parent::__construct();
        // your own logic
    }

 

    public function __toString()
    {
        return $this->getUsername();
    }

  

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Client
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Get expired
     *
     * @return boolean 
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentialsExpired
     *
     * @return boolean 
     */
    public function getCredentialsExpired()
    {
        return $this->credentialsExpired;
    }

    /**
     * Get credentialsExpireAt
     *
     * @return \DateTime 
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }




  
    /**
     * Add synchros
     *
     * @param \AppBundle\Entity\Visite $synchros
     * @return Client
     */
    public function addSynchro(\AppBundle\Entity\Synchro $synchros)
    {
        $this->synchros[] = $synchros;

        return $this;
    }

    /**
     * Remove synchros
     *
     * @param \AppBundle\Entity\Visite $synchros
     */
    public function removeSynchro(\AppBundle\Entity\Synchro $synchros)
    {
        $this->synchros->removeElement($synchros);
    }

    /**
     * Get synchros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSynchros()
    {
        return $this->synchros;
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
     * Add rapports
     *
     * @param \AppBundle\Entity\Rapport $rapports
     * @return Client
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
