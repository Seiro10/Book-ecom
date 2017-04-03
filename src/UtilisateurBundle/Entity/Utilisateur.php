<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="UtilisateurBundle\Repository\UtilisateurRepository")
 */
class Utilisateur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Constructor
     */
    public function __construct()
    {   parent::__construct();
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commande = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     *@ORM\OneToMany (targetEntity="BookBundle\Entity\UtilisateurAdresse", mappedBy="utilisateur" , cascade={"remove"})
     *@ORM\JoinColumn {nullable = true"}
     *
     */
    private $adresses;


    /**
     * @ORM\OneToMany (targetEntity="BookBundle\Entity\Commande" , mappedBy="utilisateur" , cascade={"remove"})
     * @ORM\JoinColumn {nullable = "true"}
     */
    private $commande;

    /**
     * Add adresses
     *
     * @param \BookBundle\Entity\UtilisateurAdresse $adresses
     * @return Utilisateur
     */
    public function addAdress(\BookBundle\Entity\UtilisateurAdresse $adresses)
    {
        $this->adresses[] = $adresses;

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \BookBundle\Entity\UtilisateurAdresse $adresses
     */
    public function removeAdress(\BookBundle\Entity\UtilisateurAdresse $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Add commande
     *
     * @param \BookBundle\Entity\Commande $commande
     * @return Utilisateur
     */
    public function addCommande(\BookBundle\Entity\Commande $commande)
    {
        $this->commande[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \BookBundle\Entity\Commande $commande
     */
    public function removeCommande(\BookBundle\Entity\Commande $commande)
    {
        $this->commande->removeElement($commande);
    }

    /**
     * Get commande
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommande()
    {
        return $this->commande;
    }
}
