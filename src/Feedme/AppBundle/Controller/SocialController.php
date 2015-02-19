<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class SocialController
 * @package Feedme\AppBundle\Controller
 */
class SocialController extends Controller
{
    /**
     * @Route("/wall", name="wall")
     * @Route("/wall/{id}", name="wall_id")
     * @param Request $request
     * @return JsonResponse
     */
    public function asynchWallAction(Request $request)
    {
        return $this->render('AppBundle:Social:wall.html.twig', ['userId' => $request->get('id')]);
    }

    /**
     * @Route("/members", name="members")
     * @return JsonResponse
     */
    public function asynchMembersAction()
    {

        return $this->render('AppBundle:Social:members.html.twig', ['members' => []]);
    }

}
