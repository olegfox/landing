<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\SettingsRepository")
 */
class Settings
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
    protected $keyP;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $valueP;

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
     * Set keyP
     *
     * @param string $keyP
     * @return Settings
     */
    public function setKeyP($keyP)
    {
        $this->keyP = $keyP;

        return $this;
    }

    /**
     * Get keyP
     *
     * @return string 
     */
    public function getKeyP()
    {
        return $this->keyP;
    }

    /**
     * Set valueP
     *
     * @param string $valueP
     * @return Settings
     */
    public function setValueP($valueP)
    {
        $this->valueP = $valueP;

        return $this;
    }

    /**
     * Get valueP
     *
     * @return string 
     */
    public function getValueP()
    {
        return $this->valueP;
    }
}
