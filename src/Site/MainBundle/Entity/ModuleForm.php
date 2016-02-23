<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mailerHost;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mailerUser;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mailerPassword;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $emailTo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $themeLetter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $emailFrom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $emailFromTitle;

    /**
     * @Assert\File()
     */
    protected $file;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $backgroundImg;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $backgroundColor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $backgroundPosition;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $backgroundAttachment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $backgroundSize;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $shadow;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $blur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enable = true;

    /**
     * @ORM\OneToMany(targetEntity="ModuleFormField", mappedBy="moduleForm", cascade={"persist", "remove"})
     **/
    protected $fields;

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

    /**
     * Set mailerHost
     *
     * @param string $mailerHost
     * @return ModuleForm
     */
    public function setMailerHost($mailerHost)
    {
        $this->mailerHost = $mailerHost;

        return $this;
    }

    /**
     * Get mailerHost
     *
     * @return string 
     */
    public function getMailerHost()
    {
        return $this->mailerHost;
    }

    /**
     * Set mailerPassword
     *
     * @param string $mailerPassword
     * @return ModuleForm
     */
    public function setMailerPassword($mailerPassword)
    {
        $this->mailerPassword = $mailerPassword;

        return $this;
    }

    /**
     * Get mailerPassword
     *
     * @return string 
     */
    public function getMailerPassword()
    {
        return $this->mailerPassword;
    }

    /**
     * Set emailTo
     *
     * @param string $emailTo
     * @return ModuleForm
     */
    public function setEmailTo($emailTo)
    {
        $this->emailTo = $emailTo;

        return $this;
    }

    /**
     * Get emailTo
     *
     * @return string 
     */
    public function getEmailTo()
    {
        return $this->emailTo;
    }

    /**
     * Set themeLetter
     *
     * @param string $themeLetter
     * @return ModuleForm
     */
    public function setThemeLetter($themeLetter)
    {
        $this->themeLetter = $themeLetter;

        return $this;
    }

    /**
     * Get themeLetter
     *
     * @return string 
     */
    public function getThemeLetter()
    {
        return $this->themeLetter;
    }

    /**
     * Set emailFrom
     *
     * @param string $emailFrom
     * @return ModuleForm
     */
    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;

        return $this;
    }

    /**
     * Get emailFrom
     *
     * @return string 
     */
    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    /**
     * Set emailFromTitle
     *
     * @param string $emailFromTitle
     * @return ModuleForm
     */
    public function setEmailFromTitle($emailFromTitle)
    {
        $this->emailFromTitle = $emailFromTitle;

        return $this;
    }

    /**
     * Get emailFromTitle
     *
     * @return string 
     */
    public function getEmailFromTitle()
    {
        return $this->emailFromTitle;
    }

    /**
     * Set backgroundImg
     *
     * @param string $backgroundImg
     * @return ModuleForm
     */
    public function setBackgroundImg($backgroundImg)
    {
        $this->backgroundImg = $backgroundImg;

        return $this;
    }

    /**
     * Get backgroundImg
     *
     * @return string 
     */
    public function getBackgroundImg()
    {
        return $this->backgroundImg;
    }

    /**
     * Set backgroundColor
     *
     * @param string $backgroundColor
     * @return ModuleForm
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * Get backgroundColor
     *
     * @return string 
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set backgroundPosition
     *
     * @param string $backgroundPosition
     * @return ModuleForm
     */
    public function setBackgroundPosition($backgroundPosition)
    {
        $this->backgroundPosition = $backgroundPosition;

        return $this;
    }

    /**
     * Get backgroundPosition
     *
     * @return string 
     */
    public function getBackgroundPosition()
    {
        return $this->backgroundPosition;
    }

    /**
     * Set backgroundAttachment
     *
     * @param string $backgroundAttachment
     * @return ModuleForm
     */
    public function setBackgroundAttachment($backgroundAttachment)
    {
        $this->backgroundAttachment = $backgroundAttachment;

        return $this;
    }

    /**
     * Get backgroundAttachment
     *
     * @return string 
     */
    public function getBackgroundAttachment()
    {
        return $this->backgroundAttachment;
    }

    /**
     * Set backgroundSize
     *
     * @param string $backgroundSize
     * @return ModuleForm
     */
    public function setBackgroundSize($backgroundSize)
    {
        $this->backgroundSize = $backgroundSize;

        return $this;
    }

    /**
     * Get backgroundSize
     *
     * @return string 
     */
    public function getBackgroundSize()
    {
        return $this->backgroundSize;
    }

    /**
     * Set shadow
     *
     * @param string $shadow
     * @return ModuleForm
     */
    public function setShadow($shadow)
    {
        $this->shadow = $shadow;

        return $this;
    }

    /**
     * Get shadow
     *
     * @return string 
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Set blur
     *
     * @param string $blur
     * @return ModuleForm
     */
    public function setBlur($blur)
    {
        $this->blur = $blur;

        return $this;
    }

    /**
     * Get blur
     *
     * @return string 
     */
    public function getBlur()
    {
        return $this->blur;
    }

    public function getAbsolutePath()
    {
        return null === $this->backgroundImg
            ? null
            : $this->getUploadRootDir().'/'.$this->backgroundImg;
    }

    public function getWebPath()
    {
        return null === $this->backgroundImg
            ? null
            : $this->getUploadDir().'/'.$this->backgroundImg;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/' . $this->getLevel()->getPage()->getProject()->getSlug() . '/moduleForm';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        $this->upload();
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        if (isset($this->backgroundImg)) {
            if(file_exists($this->getUploadDir().'/'.$this->backgroundImg)){
                unlink($this->getUploadDir().'/'.$this->backgroundImg);
            }
            $this->backgroundImg = null;
        }

        $this->backgroundImg = $this->getFile()->getClientOriginalName();

        $this->getFile()->move(
            $this->getUploadDir(),
            $this->backgroundImg
        );

        $this->file = null;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fields
     *
     * @param \Site\MainBundle\Entity\ModuleFormField $fields
     * @return ModuleForm
     */
    public function addField(\Site\MainBundle\Entity\ModuleFormField $fields)
    {
        $this->fields[] = $fields;

        return $this;
    }

    /**
     * Remove fields
     *
     * @param \Site\MainBundle\Entity\ModuleFormField $fields
     */
    public function removeField(\Site\MainBundle\Entity\ModuleFormField $fields)
    {
        $this->fields->removeElement($fields);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set mailerUser
     *
     * @param string $mailerUser
     * @return ModuleForm
     */
    public function setMailerUser($mailerUser)
    {
        $this->mailerUser = $mailerUser;

        return $this;
    }

    /**
     * Get mailerUser
     *
     * @return string 
     */
    public function getMailerUser()
    {
        return $this->mailerUser;
    }
}
