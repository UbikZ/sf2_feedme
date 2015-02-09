<?php

namespace Feedme\LaunchingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package Feedme\LaunchingBundle\Controller
 */
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
        $user = $this->getUser();

        return $this->render('LaunchingBundle:Default:index.html.twig', ['user' => $user]);
    }
}
