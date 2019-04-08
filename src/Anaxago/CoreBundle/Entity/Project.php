<?php

namespace Anaxago\CoreBundle\Entity;

use Anaxago\CoreBundle\Enum\StatutEnum;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="statut", type="string", length=50, nullable=false)
     */
    private $statut;

    /**
     * @var integer
     * @ORM\Column(name="seuilDeFinancement", type="integer", nullable=true)
     */
    private $seuilDeFinancement;

    /**
     * @var integer
     * @ORM\Column(name="montant", type="integer", nullable=true)
     */
    private $montant;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->statut = StatutEnum::STATUT_NON_FINANCE;
        $this->montant = 0;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * Set statut
     *
     * @param string $statut
     *
     * @return Project
     */
    public function setStatut($statut)
    {
        if (!in_array($statut, StatutEnum::getAvailableTypes())) {
            throw new \InvalidArgumentException("Invalid statut");
        }

        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Get seuilDeFinancement
     *
     * @return int
     */
    public function getSeuilDeFinancement()
    {
        return $this->seuilDeFinancement;
    }

    /**
     * Set seuilDeFinancement
     *
     * @param integer $seuilDeFinancement
     *
     * @return Project
     */
    public function setSeuilDeFinancement(int $seuilDeFinancement): Project
    {
        $this->seuilDeFinancement += $seuilDeFinancement;

        return $this;
    }

    /**
     * Get montant
     *
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return Project
     */
    public function setMontant(int $montant): Project
    {
        $this->montant += $montant;

        return $this;
    }
}

