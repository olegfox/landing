<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\ModuleComment
 *
 * @ORM\Table(name="module_comment")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleCommentRepository")
 */
class ModuleComment
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $width;

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
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enable = true;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $shadow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $shadowText;

    /**
     * @ORM\OneToOne(targetEntity="Level", inversedBy="moduleComment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $level;

    /**
     * @ORM\OneToMany(targetEntity="ModuleCommentComments", mappedBy="moduleComment", cascade={"persist", "remove"})
     **/
    protected $comments;

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
        return 'uploads/' . $this->getLevel()->getPage()->getProject()->getSlug() . '/moduleComment';
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return ModuleLine
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
     * Set backgroundImg
     *
     * @param string $backgroundImg
     * @return ModuleLine
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
     * @return ModuleLine
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
     * @return ModuleLine
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
     * @return ModuleLine
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
     * @return ModuleLine
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
     * Set level
     *
     * @param \Site\MainBundle\Entity\Level $level
     * @return ModuleLine
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
     * Set enable
     *
     * @param boolean $enable
     * @return ModuleLine
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
     * Set width
     *
     * @param string $width
     * @return ModuleLine
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
     * Set shadow
     *
     * @param string $shadow
     * @return ModuleLine
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
     * Set shadowText
     *
     * @param string $shadowText
     * @return ModuleLine
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \Site\MainBundle\Entity\ModuleCommentComments $comments
     * @return ModuleComment
     */
    public function addComment(\Site\MainBundle\Entity\ModuleCommentComments $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Site\MainBundle\Entity\ModuleCommentComments $comments
     */
    public function removeComment(\Site\MainBundle\Entity\ModuleCommentComments $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
