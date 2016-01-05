<?php

namespace Site\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SiteMainBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
