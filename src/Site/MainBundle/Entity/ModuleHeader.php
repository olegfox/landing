<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\ModuleHeader
 *
 * @ORM\Table(name="module_header")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleHeaderRepository")
 */
class ModuleHeader
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\File()
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $backgroundImg;

    /**
     * @Assert\File()
     */
    protected $fileVideo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $video;

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
    protected $shadow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $head1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $head2;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isButton = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $textButton;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $hintLeft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $hintRight1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $hintRight2;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isArrow = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isArrowFlashing = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enable = false;

    /**
     * @ORM\OneToOne(targetEntity="Level", inversedBy="moduleHeader", cascade={"persist", "remove"})
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
        return 'uploads/moduleHeader';
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


    public function getAbsolutePathVideo()
    {
        return null === $this->video
            ? null
            : $this->getUploadRootDirVideo().'/'.$this->video;
    }

    public function getWebPathVideo()
    {
        return null === $this->video
            ? null
            : $this->getUploadDirVideo().'/'.$this->video;
    }

    protected function getUploadRootDirVideo()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDirVideo();
    }

    protected function getUploadDirVideo()
    {
        return 'uploads/moduleHeader';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $fileVideo
     */
    public function setFileVideo(UploadedFile $fileVideo = null)
    {
        $this->fileVideo = $fileVideo;

        $this->uploadVideo();
    }

    /**
     * Get fileVideo.
     *
     * @return UploadedFile
     */
    public function getFileVideo()
    {
        return $this->fileVideo;
    }

    public function uploadVideo()
    {
        if (null === $this->getFileVideo()) {
            return;
        }

        if (isset($this->video)) {
            if(file_exists($this->getUploadDirVideo().'/'.$this->video)){
                unlink($this->getUploadDirVideo().'/'.$this->video);
            }
            $this->video = null;
        }

        $this->video = $this->getFileVideo()->getClientOriginalName();

        $this->getFileVideo()->move(
            $this->getUploadDirVideo(),
            $this->video
        );

        $this->fileVideo = null;
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
     * Set backgroundImg
     *
     * @param string $backgroundImg
     * @return ModuleHeader
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
     * Set video
     *
     * @param string $video
     * @return ModuleHeader
     */
    public function setVideo($video)
    {
        if (empty($video)) {
            if(file_exists($this->getUploadDirVideo().'/'.$this->video)){
                unlink($this->getUploadDirVideo().'/'.$this->video);
            }
        }

        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set backgroundPosition
     *
     * @param string $backgroundPosition
     * @return ModuleHeader
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
     * @return ModuleHeader
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
     * @return ModuleHeader
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
     * @return ModuleHeader
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
     * Set head1
     *
     * @param string $head1
     * @return ModuleHeader
     */
    public function setHead1($head1)
    {
        $this->head1 = $head1;

        return $this;
    }

    /**
     * Get head1
     *
     * @return string 
     */
    public function getHead1()
    {
        return $this->head1;
    }

    /**
     * Set head2
     *
     * @param string $head2
     * @return ModuleHeader
     */
    public function setHead2($head2)
    {
        $this->head2 = $head2;

        return $this;
    }

    /**
     * Get head2
     *
     * @return string 
     */
    public function getHead2()
    {
        return $this->head2;
    }

    /**
     * Set isButton
     *
     * @param boolean $isButton
     * @return ModuleHeader
     */
    public function setIsButton($isButton)
    {
        $this->isButton = $isButton;

        return $this;
    }

    /**
     * Get isButton
     *
     * @return boolean 
     */
    public function getIsButton()
    {
        return $this->isButton;
    }

    /**
     * Set textButton
     *
     * @param string $textButton
     * @return ModuleHeader
     */
    public function setTextButton($textButton)
    {
        $this->textButton = $textButton;

        return $this;
    }

    /**
     * Get textButton
     *
     * @return string 
     */
    public function getTextButton()
    {
        return $this->textButton;
    }

    /**
     * Set hintLeft
     *
     * @param string $hintLeft
     * @return ModuleHeader
     */
    public function setHintLeft($hintLeft)
    {
        $this->hintLeft = $hintLeft;

        return $this;
    }

    /**
     * Get hintLeft
     *
     * @return string 
     */
    public function getHintLeft()
    {
        return $this->hintLeft;
    }

    /**
     * Set hintRight1
     *
     * @param string $hintRight1
     * @return ModuleHeader
     */
    public function setHintRight1($hintRight1)
    {
        $this->hintRight1 = $hintRight1;

        return $this;
    }

    /**
     * Get hintRight1
     *
     * @return string 
     */
    public function getHintRight1()
    {
        return $this->hintRight1;
    }

    /**
     * Set hintRight2
     *
     * @param string $hintRight2
     * @return ModuleHeader
     */
    public function setHintRight2($hintRight2)
    {
        $this->hintRight2 = $hintRight2;

        return $this;
    }

    /**
     * Get hintRight2
     *
     * @return string 
     */
    public function getHintRight2()
    {
        return $this->hintRight2;
    }

    /**
     * Set isArrow
     *
     * @param boolean $isArrow
     * @return ModuleHeader
     */
    public function setIsArrow($isArrow)
    {
        $this->isArrow = $isArrow;

        return $this;
    }

    /**
     * Get isArrow
     *
     * @return boolean 
     */
    public function getIsArrow()
    {
        return $this->isArrow;
    }

    /**
     * Set isArrowFlashing
     *
     * @param boolean $isArrowFlashing
     * @return ModuleHeader
     */
    public function setIsArrowFlashing($isArrowFlashing)
    {
        $this->isArrowFlashing = $isArrowFlashing;

        return $this;
    }

    /**
     * Get isArrowFlashing
     *
     * @return boolean 
     */
    public function getIsArrowFlashing()
    {
        return $this->isArrowFlashing;
    }

    /**
     * Set level
     *
     * @param \Site\MainBundle\Entity\Level $level
     * @return ModuleHeader
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
     * @return ModuleHeader
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
}
