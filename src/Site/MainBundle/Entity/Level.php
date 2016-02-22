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
     * @ORM\JoinColumn(name="moduleHeader_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $moduleHeader;

    /**
     * @ORM\OneToOne(targetEntity="ModuleLine", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="moduleLine_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $moduleLine;

    /**
     * @ORM\OneToOne(targetEntity="ModuleSquare", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="moduleSquare_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $moduleSquare;

    /**
     * @ORM\OneToOne(targetEntity="ModuleMap", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="moduleMap_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $moduleMap;

    /**
     * @ORM\OneToOne(targetEntity="ModuleComment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="moduleComment_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $moduleComment;

    /**
     * @ORM\OneToOne(targetEntity="ModuleForm", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="moduleForm_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $moduleForm;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $type;

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

    /**
     * Set moduleLine
     *
     * @param \Site\MainBundle\Entity\ModuleLine $moduleLine
     * @return Level
     */
    public function setModuleLine(\Site\MainBundle\Entity\ModuleLine $moduleLine = null)
    {
        $this->moduleLine = $moduleLine;
        $moduleLine->setLevel($this);

        return $this;
    }

    /**
     * Get moduleLine
     *
     * @return \Site\MainBundle\Entity\ModuleLine 
     */
    public function getModuleLine()
    {
        return $this->moduleLine;
    }

    /**
     * Set moduleSquare
     *
     * @param \Site\MainBundle\Entity\ModuleSquare $moduleSquare
     * @return Level
     */
    public function setModuleSquare(\Site\MainBundle\Entity\ModuleSquare $moduleSquare = null)
    {
        $this->moduleSquare = $moduleSquare;
        $moduleSquare->setLevel($this);

        return $this;
    }

    /**
     * Get moduleSquare
     *
     * @return \Site\MainBundle\Entity\ModuleSquare 
     */
    public function getModuleSquare()
    {
        return $this->moduleSquare;
    }

    /**
     * Set moduleMap
     *
     * @param \Site\MainBundle\Entity\ModuleMap $moduleMap
     * @return Level
     */
    public function setModuleMap(\Site\MainBundle\Entity\ModuleMap $moduleMap = null)
    {
        $this->moduleMap = $moduleMap;
        $moduleMap->setLevel($this);

        return $this;
    }

    /**
     * Get moduleMap
     *
     * @return \Site\MainBundle\Entity\ModuleMap 
     */
    public function getModuleMap()
    {
        return $this->moduleMap;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Level
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
     * Set moduleComment
     *
     * @param \Site\MainBundle\Entity\ModuleComment $moduleComment
     * @return Level
     */
    public function setModuleComment(\Site\MainBundle\Entity\ModuleComment $moduleComment = null)
    {
        $this->moduleComment = $moduleComment;

        return $this;
    }

    /**
     * Get moduleComment
     *
     * @return \Site\MainBundle\Entity\ModuleComment 
     */
    public function getModuleComment()
    {
        return $this->moduleComment;
    }

    /**
     * Set moduleForm
     *
     * @param \Site\MainBundle\Entity\ModuleForm $moduleForm
     * @return Level
     */
    public function setModuleForm(\Site\MainBundle\Entity\ModuleForm $moduleForm = null)
    {
        $this->moduleForm = $moduleForm;

        return $this;
    }

    /**
     * Get moduleForm
     *
     * @return \Site\MainBundle\Entity\ModuleForm 
     */
    public function getModuleForm()
    {
        return $this->moduleForm;
    }
}
