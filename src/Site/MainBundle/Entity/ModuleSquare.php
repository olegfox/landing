<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\ModuleSquare
 *
 * @ORM\Table(name="module_square")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleSquareRepository")
 */
class ModuleSquare
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $countSquareInCol;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $fontSize;

    /**
     * @Assert\File()
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $height;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $shadowHover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $shadowText;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enable = true;

    /**
     * @ORM\OneToMany(targetEntity="ModuleSquareSquare", mappedBy="moduleSquare", cascade={"persist", "remove"})
     **/
    protected $squares;

    /**
     * @ORM\OneToOne(targetEntity="Level", inversedBy="moduleSquare", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $level;

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
        return 'uploads/' . $this->getLevel()->getPage()->getProject()->getSlug() . '/moduleSquare';
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
     * Set backgroundImg
     *
     * @param string $backgroundImg
     * @return ModuleSquare
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
     * Constructor
     */
    public function __construct()
    {
        $this->squares = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set countSquareInCol
     *
     * @param integer $countSquareInCol
     * @return ModuleSquare
     */
    public function setCountSquareInCol($countSquareInCol)
    {
        $this->countSquareInCol = $countSquareInCol;

        return $this;
    }

    /**
     * Get countSquareInCol
     *
     * @return integer 
     */
    public function getCountSquareInCol()
    {
        return $this->countSquareInCol;
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
     * @return ModuleSquare
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
     * @return ModuleSquare
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
     * @return ModuleSquare
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
     * @return ModuleSquare
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
     * @return ModuleSquare
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
     * @return ModuleSquare
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
     * Set enable
     *
     * @param boolean $enable
     * @return ModuleSquare
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
     * Add squares
     *
     * @param \Site\MainBundle\Entity\ModuleSquareSquare $squares
     * @return ModuleSquare
     */
    public function addSquare(\Site\MainBundle\Entity\ModuleSquareSquare $squares)
    {
        $this->squares[] = $squares;

        return $this;
    }

    /**
     * Remove squares
     *
     * @param \Site\MainBundle\Entity\ModuleSquareSquare $squares
     */
    public function removeSquare(\Site\MainBundle\Entity\ModuleSquareSquare $squares)
    {
        $this->squares->removeElement($squares);
    }

    /**
     * Get squares
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSquares()
    {
        return $this->squares;
    }

    /**
     * Set level
     *
     * @param \Site\MainBundle\Entity\Level $level
     * @return ModuleSquare
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
     * Set fontSize
     *
     * @param string $fontSize
     * @return ModuleSquare
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * Get fontSize
     *
     * @return string 
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return ModuleSquare
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
     * Set shadowHover
     *
     * @param string $shadowHover
     * @return ModuleSquare
     */
    public function setShadowHover($shadowHover)
    {
        $this->shadowHover = $shadowHover;

        return $this;
    }

    /**
     * Get shadowHover
     *
     * @return string 
     */
    public function getShadowHover()
    {
        return $this->shadowHover;
    }

    /**
     * Set shadowText
     *
     * @param string $shadowText
     * @return ModuleSquare
     */
    public function setShadowText($shadowText)
    {
        $this->shadowText = $shadowText;

        return $this;
    }

    /**
     * Get shadowText
     *
     * @return string 
     */
    public function getShadowText()
    {
        return $this->shadowText;
    }
}
