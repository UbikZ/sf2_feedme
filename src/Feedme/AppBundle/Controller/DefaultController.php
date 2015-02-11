<?php

namespace Feedme\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/app", name="app")
     */
    public function indexAction()
    {
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Vos changements ont été sauvegardés!'
        );

        return $this->render('AppBundle:Default:index.html.twig', ['user' => $this->getUser()]);
    }

    /**
     * @Route("/me", name="me")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            $this->createNotFoundException();
        }

        $serializer = new Serializer([new GetSetMethodNormalizer()], [new JsonEncoder()]);

        return new JsonResponse($serializer->serialize($this->getUser(), 'json'));
    }


}
