<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route(
     *      "/{_locale}",
     *      requirements={"_locale" = "en|fr"},
     *      defaults={"_locale" = "en"},
     *      name="homepage"
     * )
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
