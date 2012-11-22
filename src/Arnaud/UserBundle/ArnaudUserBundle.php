<?php

namespace Arnaud\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArnaudUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}