<?php

namespace Feedme\AppBundle\Controller;

use Feedme\FeedmeUserBundle\Model\Service\FeedmeUserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Feedme\FeedmeUserBundle\Model\Service\Filter\User as UserFilter;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function asynchMembersAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            $this->createNotFoundException();
        }
        /** @var FeedmeUserService $userService */
        $userService = $this->get('feedme.user.service');

        $filter = new UserFilter();
        $filter->id = $request->get('id', $this->getUser()->getId());
        $resultUser = $userService->findBy($filter);

        return $this->render('AppBundle:Social:members.html.twig', ['members' => []]);
    }

}
