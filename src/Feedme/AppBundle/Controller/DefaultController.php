<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class DefaultController
 * @package Feedme\AppBundle\Controller
 */
class DefaultController extends Controller
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
     * todo: nasty! clean the json stuffs
     * @Route("/me", name="me")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function asynchUserAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            $this->createNotFoundException();
        }

        $serializer = new Serializer([new GetSetMethodNormalizer()], [new JsonEncoder()]);
        $array = @json_decode($serializer->serialize($this->getUser(), 'json'), true);
        $array = array_merge_recursive(
            $array,
            ['gravatar' => [
                80 => $this->get('gravatar.api')->getUrl($this->getUser()->getEmail()),
                250 => $this->get('gravatar.api')->getUrl($this->getUser()->getEmail(), 250)
            ]]
        );

        return new JsonResponse(json_encode($array));
    }
}
