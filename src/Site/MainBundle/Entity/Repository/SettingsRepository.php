<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SettingsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SettingsRepository extends EntityRepository
{

    /**
     * Список параметров в массиве
     *
     * @return array
     */
    public function findAllArray() {
        $settings = $this->findAll();
        $settingArray = [];

        foreach($settings as $parameter) {
            $settingArray[$parameter->getKeyP()] = $parameter->getValueP();
        }

        return $settingArray;
    }
}