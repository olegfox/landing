<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\ModuleSquareSquare
 *
 * @ORM\Table(name="module_square_square")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleSquareSquareRepository")
 */
class ModuleSquareSquare
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $paddingTitle;

    /**
     * @Assert\File()
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $backgroundImg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $backgroundColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $backgroundPosition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $backgroundAttachment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $backgroundSize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $blur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $shadow;

    /**
     * @Assert\File()
     */
    protected $fileIcon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $icon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $paddingIcon;

    /**
     * @ORM\ManyToOne(targetEntity="ModuleSquare", inversedBy="squareas")
     * @ORM\JoinColumn(name="module_square_id", referencedColumnName="id")
     **/
    protected $moduleSquare;

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
        return 'uploads/' . $this->getModuleSquare()->getLevel()->getPage()->getProject()->getSlug() . '/moduleSquare';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
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

    public function getAbsolutePathIcon()
    {
        return null === $this->icon
            ? null
            : $this->getUploadRootDirIcon().'/'.$this->icon;
    }

    public function getWebPathIcon()
    {
        return null === $this->icon
            ? null
            : $this->getUploadDirIcon().'/'.$this->icon;
    }

    protected function getUploadRootDirIcon()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDirIcon();
    }

    protected function getUploadDirIcon()
    {
        return 'uploads/' . $this->getModuleSquare()->getLevel()->getPage()->getProject()->getSlug() . '/moduleSquare';
    }

    /**
     * Sets fileIcon.
     *
     * @param UploadedFile $fileIcon
     */
    public function setFileIcon(UploadedFile $fileIcon = null)
    {
        $this->fileIcon = $fileIcon;
    }

    /**
     * Get fileIcon.
     *
     * @return UploadedFile
     */
    public function getFileIcon()
    {
        return $this->fileIcon;
    }

    public function uploadIcon()
    {
        if (null === $this->getFileIcon()) {
            return;
        }

        if (isset($this->icon)) {
            if(file_exists($this->getUploadDirIcon().'/'.$this->icon)){
                unlink($this->getUploadDirIcon().'/'.$this->icon);
            }
            $this->icon = null;
        }

        $this->icon = $this->getFileIcon()->getClientOriginalName();

        $this->getFileIcon()->move(
            $this->getUploadDirIcon(),
            $this->icon
        );

        $this->fileIcon= null;
    }

    /**
     * Set backgroundImg
     *
     * @param string $backgroundImg
     * @return ModuleSquareSquare
     */
    public function setBackgroundImg($backgroundImg)
    {
        if (empty($backgroundImg)) {
            if(file_exists($this->getUploadDir().'/'.$this->backgroundImg)){
                unlink($this->getUploadDir().'/'.$this->backgroundImg);
            }
        }

        $this->backgroundImg = $backgroundImg;

        return $this;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return ModuleLine
     */
    public function setIcon($icon)
    {
        if (empty($icon)) {
            if(file_exists($this->getUploadDirIcon().'/'.$this->icon)){
                unlink($this->getUploadDirIcon().'/'.$this->icon);
            }
        }

        $this->icon = $icon;

        return $this;
    }

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
     * @return ModuleSquareSquare
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
     * @return ModuleSquareSquare
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
     * @return ModuleSquareSquare
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
     * @return ModuleSquareSquare
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
     * Set blur
     *
     * @param string $blur
     * @return ModuleSquareSquare
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

    /**
     * Set shadow
     *
     * @param string $shadow
     * @return ModuleSquareSquare
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
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set moduleSquare
     *
     * @param \Site\MainBundle\Entity\ModuleSquare $moduleSquare
     * @return ModuleSquareSquare
     */
    public function setModuleSquare(\Site\MainBundle\Entity\ModuleSquare $moduleSquare = null)
    {
        $this->moduleSquare = $moduleSquare;

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
     * Set title
     *
     * @param string $title
     * @return ModuleSquareSquare
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
     * Set paddingTitle
     *
     * @param string $paddingTitle
     * @return ModuleSquareSquare
     */
    public function setPaddingTitle($paddingTitle)
    {
        $this->paddingTitle = $paddingTitle;

        return $this;
    }

    /**
     * Get paddingTitle
     *
     * @return string 
     */
    public function getPaddingTitle()
    {
        return $this->paddingTitle;
    }

    /**
     * Set paddingIcon
     *
     * @param string $paddingIcon
     * @return ModuleSquareSquare
     */
    public function setPaddingIcon($paddingIcon)
    {
        $this->paddingIcon = $paddingIcon;

        return $this;
    }

    /**
     * Get paddingIcon
     *
     * @return string 
     */
    public function getPaddingIcon()
    {
        return $this->paddingIcon;
    }
}
