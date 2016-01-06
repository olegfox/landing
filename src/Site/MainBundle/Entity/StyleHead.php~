<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\StyleHead
 *
 * @ORM\Table(name="style_heads")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\StyleHeadRepository")
 */
class StyleHead
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
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $color;

    /**
     * @ORM\ManyToOne(targetEntity="Style", inversedBy="heads")
     * @ORM\JoinColumn(name="style_id", referencedColumnName="id")
     **/
    protected $style;


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
     * @return StyleHead
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
     * Set link
     *
     * @param string $link
     * @return StyleHead
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return StyleHead
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return StyleHead
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set style
     *
     * @param \Site\MainBundle\Entity\Style $style
     * @return StyleHead
     */
    public function setStyle(\Site\MainBundle\Entity\Style $style = null)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return \Site\MainBundle\Entity\Style 
     */
    public function getStyle()
    {
        return $this->style;
    }
}
