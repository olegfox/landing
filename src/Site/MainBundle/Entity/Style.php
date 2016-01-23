<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Style
 *
 * @ORM\Table(name="styles")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\StyleRepository")
 */
class Style
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
    protected $font;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $cssFont;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $fontColor;

    /**
     * @ORM\OneToOne(targetEntity="Project", inversedBy="style", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $project;

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
    protected $fileFavicon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $favicon;

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
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=500, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=500, nullable=true)
     */
    private $metaKeywords;

    /**
     * @ORM\OneToMany(targetEntity="StyleHead", mappedBy="style", cascade={"persist", "remove"})
     **/
    protected $heads;

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
        return 'uploads/' . $this->getProject()->getSlug() . '/style';
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


    public function getAbsolutePathFavicon()
    {
        return null === $this->favicon
            ? null
            : $this->getUploadRootDirFavicon().'/'.$this->favicon;
    }

    public function getWebPathFavicon()
    {
        return null === $this->favicon
            ? null
            : $this->getUploadDirFavicon().'/'.$this->favicon;
    }

    protected function getUploadRootDirFavicon()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDirFavicon();
    }

    protected function getUploadDirFavicon()
    {
        return 'uploads/' . $this->getProject()->getSlug() . '/favicon';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $fileFavicon
     */
    public function setFileFavicon(UploadedFile $fileFavicon = null)
    {
        $this->fileFavicon = $fileFavicon;

        $this->uploadFavicon();
    }

    /**
     * Get fileFavicon.
     *
     * @return UploadedFile
     */
    public function getFileFavicon()
    {
        return $this->fileFavicon;
    }

    public function uploadFavicon()
    {
        if (null === $this->getFileFavicon()) {
            return;
        }

        if (isset($this->favicon)) {
            if(file_exists($this->getUploadDirFavicon().'/'.$this->favicon)){
                unlink($this->getUploadDirFavicon().'/'.$this->favicon);
            }
            $this->favicon = null;
        }

        $this->favicon = $this->getFileFavicon()->getClientOriginalName();

        $this->getFileFavicon()->move(
            $this->getUploadDirFavicon(),
            $this->favicon
        );

        $this->fileFavicon = null;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->heads = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Style
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
     * Set favicon
     *
     * @param string $favicon
     * @return Style
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get favicon
     *
     * @return string
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Set backgroundPosition
     *
     * @param string $backgroundPosition
     * @return Style
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
     * @return Style
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
     * @return Style
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
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Style
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Style
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Style
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Add heads
     *
     * @param \Site\MainBundle\Entity\StyleHead $heads
     * @return Style
     */
    public function addHead(\Site\MainBundle\Entity\StyleHead $heads)
    {
        $this->heads[] = $heads;

        return $this;
    }

    /**
     * Remove heads
     *
     * @param \Site\MainBundle\Entity\StyleHead $heads
     */
    public function removeHead(\Site\MainBundle\Entity\StyleHead $heads)
    {
        $this->heads->removeElement($heads);
    }

    /**
     * Get heads
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeads()
    {
        return $this->heads;
    }

    /**
     * Set project
     *
     * @param \Site\MainBundle\Entity\Project $project
     * @return Style
     */
    public function setProject(\Site\MainBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Site\MainBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set font
     *
     * @param string $font
     * @return Style
     */
    public function setFont($font)
    {
        $this->font = $font;

        return $this;
    }

    /**
     * Get font
     *
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set cssFont
     *
     * @param string $cssFont
     * @return Style
     */
    public function setCssFont($cssFont)
    {
        $this->cssFont = $cssFont;

        return $this;
    }

    /**
     * Get cssFont
     *
     * @return string
     */
    public function getCssFont()
    {
        return $this->cssFont;
    }

    /**
     * Set fontColor
     *
     * @param string $fontColor
     * @return Style
     */
    public function setFontColor($fontColor)
    {
        $this->fontColor = $fontColor;

        return $this;
    }

    /**
     * Get fontColor
     *
     * @return string
     */
    public function getFontColor()
    {
        return $this->fontColor;
    }
}
