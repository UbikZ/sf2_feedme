<?php

namespace Feedme\FeedmeUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FeedmeUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
