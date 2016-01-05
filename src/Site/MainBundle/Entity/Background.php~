<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Background
 *
 * @ORM\Table(name="background")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\BackgroundRepository")
 */
class Background
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
    private $img;

    /**
     * @Assert\File()
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @Assert\File()
     */
    private $videoFile;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $main = false;

    public function getAbsolutePath()
    {
        return null === $this->img
            ? null
            : $this->getUploadRootDir().'/'.$this->img;
    }

    public function getWebPath()
    {
        return null === $this->img
            ? null
            : $this->getUploadDir().'/'.$this->img;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/background';
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

        if (isset($this->img)) {
            if(file_exists($this->getUploadDir().'/'.$this->img)){
                unlink($this->getUploadDir().'/'.$this->img);
            }
            $this->img = null;
        }

        $this->img = $this->getFile()->getClientOriginalName();

        $this->getFile()->move(
            $this->getUploadDir(),
            $this->img
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
        return 'uploads/background';
    }

    /**
     * Sets videoFile.
     *
     * @param UploadedFile $videoFile
     */
    public function setVideoFile(UploadedFile $videoFile = null)
    {
        $this->videoFile = $videoFile;

        $this->uploadVideo();
    }

    /**
     * Get videoFile.
     *
     * @return UploadedFile
     */
    public function getVideoFile()
    {
        return $this->videoFile;
    }

    public function uploadVideo()
    {
        if (null === $this->getVideoFile()) {
            return;
        }

        if (isset($this->video)) {
            if(file_exists($this->getUploadDirVideo().'/'.$this->video)){
                unlink($this->getUploadDirVideo().'/'.$this->video);
            }
            $this->video = null;
        }

        $this->video = $this->getVideoFile()->getClientOriginalName();

        $this->getVideoFile()->move(
            $this->getUploadDirVideo(),
            $this->video
        );

        $this->videoFile = null;
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
     * Set img
     *
     * @param string $img
     * @return Background
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }


    /**
     * Set main
     *
     * @param boolean $main
     * @return Background
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean 
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return Background
     */
    public function setVideo($video)
    {
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
     * Set text
     *
     * @param string $text
     * @return Background
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
}
