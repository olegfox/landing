<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\ModuleForm
 *
 * @ORM\Table(name="module_form")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleFormRepository")
 */
class ModuleForm
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $height;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $width;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enable = true;

    /**
     * @ORM\OneToOne(targetEntity="Level", inversedBy="moduleForm", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $level;


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
     * @return ModuleForm
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
     * Set height
     *
     * @param string $height
     * @return ModuleForm
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param string $width
     * @return ModuleForm
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return ModuleForm
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set level
     *
     * @param \Site\MainBundle\Entity\Level $level
     * @return ModuleForm
     */
    public function setLevel(\Site\MainBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \Site\MainBundle\Entity\Level 
     */
    public function getLevel()
    {
        return $this->level;
    }
}
