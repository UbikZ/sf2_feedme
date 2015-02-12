<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProfileController
 * @package Feedme\AppBundle\Controller
 */
class WallController extends Controller
{
    /**
     * @Route("/wall", name="wall")
     * @param Request $request
     * @return JsonResponse
     */
    public function asynchWallAction(Request $request)
    {
        return $this->render('AppBundle:Wall:wall.html.twig');
    }
}
