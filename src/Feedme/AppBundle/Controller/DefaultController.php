<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Feedme\FeedmeUserBundle\Model\Service\Filter\User as UserFilter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class DefaultController
 * @package Feedme\AppBundle\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/error", name="error")
     */
    public function errorAction()
    {
        return $this->render('AppBundle:_errors:404.html.twig');
    }

    /**
     * @Route("/app", name="app")
     */
    public function indexAction()
    {

        return $this->render('AppBundle:Default:index.html.twig');
    }
    /**
     * @Route("/user", name="user")
     * @Route("/user/{id}", name="user_id")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function asynchUserAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            $this->createNotFoundException();
        }

        $filter = new UserFilter();
        $filter->id = $request->get('id', $this->getUser()->getId());
        $resultUser = $this->get('feedme.user.manager')->findOne($filter);
        $serializer = new Serializer([new GetSetMethodNormalizer()], [new JsonEncoder()]);

        return new JsonResponse($serializer->serialize($resultUser, 'json'));
    }

}
