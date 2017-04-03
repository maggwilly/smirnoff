<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Gagnant
 *
 * @ORM\Table(name="gagnant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GagnantRepository")
 */
class Gagnant
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     * @ORM\Column(name="object", type="string", length=255)
     */
    private $object;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date",nullable=false)
     */
    private $date;

    /**
     * @var int
     * @Assert\GreaterThanOrEqual( value = 18, message="Vous avez saisi un âge non autorisé.")
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PointVente",inversedBy="gagnants")
   * @ORM\JoinColumn(nullable=true)
   */
    private $pointVente;
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
     * @return Gagnant
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
     * Set tel
     *
     * @param string $tel
     * @return Gagnant
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
     * Set object
     *
     * @param string $object
     * @return Gagnant
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string 
     */
    public function getObject()
    {
        return $this->object;
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
     * Set age
     *
     * @param integer $age
     * @return Gagnant
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }
}
