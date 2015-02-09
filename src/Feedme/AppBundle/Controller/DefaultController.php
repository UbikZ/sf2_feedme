<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package Feedme\AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function indexAction()
    {
        echo "dashboard";die;
    }
}
