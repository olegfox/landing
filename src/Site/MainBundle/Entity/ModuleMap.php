<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\ModuleMap
 *
 * @ORM\Table(name="module_map")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleMapRepository")
 */
class ModuleMap
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
    protected $code;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $height;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enable = true;

    /**
     * @ORM\OneToOne(targetEntity="Level", inversedBy="moduleMap", cascade={"persist", "remove"})
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
     * Set code
     *
     * @param string $code
     * @return ModuleMap
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return ModuleMap
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
     * @return ModuleMap
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

    /**
     * Set height
     *
     * @param string $height
     * @return ModuleMap
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
}
