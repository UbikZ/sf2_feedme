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
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Vos changements ont été sauvegardés!'
        );

        return $this->render('AppBundle:Default:index.html.twig', ['user' => $this->getUser()]);
    }
}
