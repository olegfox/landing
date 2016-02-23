<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\ModuleFormField
 *
 * @ORM\Table(name="module_form_field")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleFormFieldRepository")
 */
class ModuleFormField
{

    const TYPE_TEXT = 0;
    const TYPE_EMAIL = 1;
    const TYPE_SUBMIT = 2;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $placeholder;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $enableRequire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $enableLabel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $enablePlaceholder;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $validateMessage;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="ModuleForm", inversedBy="fields")
     * @ORM\JoinColumn(name="module_form_id", referencedColumnName="id")
     **/
    protected $moduleForm;

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
     * @return ModuleFormField
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
     * Set type
     *
     * @param integer $type
     * @return ModuleFormField
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set enableLabel
     *
     * @param integer $enableLabel
     * @return ModuleFormField
     */
    public function setEnableLabel($enableLabel)
    {
        $this->enableLabel = $enableLabel;

        return $this;
    }

    /**
     * Get enableLabel
     *
     * @return integer 
     */
    public function getEnableLabel()
    {
        return $this->enableLabel;
    }

    /**
     * Set placeholder
     *
     * @param string $placeholder
     * @return ModuleFormField
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get placeholder
     *
     * @return string 
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set enableRequire
     *
     * @param integer $enableRequire
     * @return ModuleFormField
     */
    public function setEnableRequire($enableRequire)
    {
        $this->enableRequire = $enableRequire;

        return $this;
    }

    /**
     * Get enableRequire
     *
     * @return integer 
     */
    public function getEnableRequire()
    {
        return $this->enableRequire;
    }

    /**
     * Set validateMessage
     *
     * @param string $validateMessage
     * @return ModuleFormField
     */
    public function setValidateMessage($validateMessage)
    {
        $this->validateMessage = $validateMessage;

        return $this;
    }

    /**
     * Get validateMessage
     *
     * @return string 
     */
    public function getValidateMessage()
    {
        return $this->validateMessage;
    }

    /**
     * Set moduleForm
     *
     * @param \Site\MainBundle\Entity\ModuleForm $moduleForm
     * @return ModuleFormField
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

    /**
     * Set enablePlaceholder
     *
     * @param integer $enablePlaceholder
     * @return ModuleFormField
     */
    public function setEnablePlaceholder($enablePlaceholder)
    {
        $this->enablePlaceholder = $enablePlaceholder;

        return $this;
    }

    /**
     * Get enablePlaceholder
     *
     * @return integer 
     */
    public function getEnablePlaceholder()
    {
        return $this->enablePlaceholder;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ModuleFormField
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
}
