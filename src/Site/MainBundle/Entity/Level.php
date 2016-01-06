<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\Level
 *
 * @ORM\Table(name="levels")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\LevelRepository")
 */
class Level
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="levels")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     **/
    protected $page;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position = 0;

    /**
     * @ORM\OneToOne(targetEntity="ModuleHeader", cascade={"persist", "remove"})
     */
    protected $moduleHeader;

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
     * Set title
     *
     * @param string $title
     * @return Level
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
     * Set slug
     *
     * @param string $slug
     * @return Level
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
     * Set page
     *
     * @param \Site\MainBundle\Entity\Page $page
     * @return Level
     */
    public function setPage(\Site\MainBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Site\MainBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Level
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set moduleHeader
     *
     * @param \Site\MainBundle\Entity\ModuleHeader $moduleHeader
     * @return Level
     */
    public function setModuleHeader(\Site\MainBundle\Entity\ModuleHeader $moduleHeader = null)
    {
        $this->moduleHeader = $moduleHeader;
        $moduleHeader->setLevel($this);
        return $this;
    }

    /**
     * Get moduleHeader
     *
     * @return \Site\MainBundle\Entity\ModuleHeader 
     */
    public function getModuleHeader()
    {
        return $this->moduleHeader;
    }
}
