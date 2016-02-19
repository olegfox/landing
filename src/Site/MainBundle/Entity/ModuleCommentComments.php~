<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\ModuleCommentComments
 *
 * @ORM\Table(name="module_comment_comments")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ModuleCommentCommentsRepository")
 */
class ModuleCommentComments
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $img;

    /**
     * @ORM\ManyToOne(targetEntity="ModuleComment", inversedBy="comments")
     * @ORM\JoinColumn(name="module_comment_id", referencedColumnName="id")
     **/
    protected $moduleComment;

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
        return 'uploads/' . $this->getModuleComment()->getLevel()->getPage()->getProject()->getSlug() . '/moduleComment';
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
     * @return ModuleCommentComments
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
     * Set moduleComment
     *
     * @param \Site\MainBundle\Entity\ModuleComment $moduleComment
     * @return ModuleCommentComments
     */
    public function setModuleComment(\Site\MainBundle\Entity\ModuleComment $moduleComment = null)
    {
        $this->moduleComment = $moduleComment;

        return $this;
    }

    /**
     * Get moduleComment
     *
     * @return \Site\MainBundle\Entity\ModuleComment 
     */
    public function getModuleComment()
    {
        return $this->moduleComment;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return ModuleCommentComments
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
