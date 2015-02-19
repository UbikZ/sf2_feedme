<?php

namespace Feedme\FeedmeUserBundle\Model\Service;

use Feedme\FeedmeUserBundle\Model\Manager\FeedmeUserManager;
use Feedme\FeedmeUserBundle\Model\Message\Result;
use Feedme\FeedmeUserBundle\Model\Service\Filter\User as UserFilter;
use Feedme\FeedmeUserBundle\Model\Entity\User;
use Ornicar\GravatarBundle\GravatarApi;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class FeedmeUserService
 * @package Feedme\FeedmeUserBundle\Service
 */
class FeedmeUserService
{
    /**
     * @var FeedmeUserManager
     */
    protected $userManager;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var GravatarApi
     */
    protected $gravatar;

    /**
     * @param FeedmeUserManager $manager
     * @param TranslatorInterface $translator
     * @param GravatarApi $gravatar
     */
    public function __construct(FeedmeUserManager $manager, TranslatorInterface $translator, GravatarApi $gravatar)
    {
        $this->userManager = $manager;
        $this->translator = $translator;
        $this->gravatar = $gravatar;
    }

    /**
     * @param UserFilter $filter
     * @return array
     */
    private function parseFilter(UserFilter $filter)
    {
        $params = [];
        if ($filter->id) {
            $params['id'] = $filter->id;
        }
        if ($filter->firstname) {
            $params['firstname'] = $filter->firstname;
        }
        if ($filter->lastname) {
            $params['lastname'] = $filter->lastname;
        }
        if ($filter->username) {
            $params['username'] = $filter->username;
        }

        return $params;
    }

    /**
     * @param UserFilter $filter
     * @return Result
     */
    public function findOne(UserFilter $filter)
    {
        $result = new Result();
        $params = $this->parseFilter($filter);
        try {
            /** @var User $user */
            $user = $this->userManager->findUserBy($params);
            if (is_null($user)) {
                throw new \Exception();
            }
            $result->setMessage($this->populateUser($user));
            $result->setSuccess(true);
        } catch (\Exception $e) {
            $result->setError($this->translator->trans('feedme.user.manager.select.error'));
        }

        return $result;
    }

    public function findBy(UserFilter $filter)
    {
        $result = new Result();
        $params = $this->parseFilter($filter);
        try {
            /** @var User[] $user */
            $users = $this->userManager->findBy($params);
            if (is_null($user)) {
                throw new \Exception();
            }
            $result->setMessage($user);
            $result->setSuccess(true);
        } catch (\Exception $e) {
            $result->setError($this->translator->trans('feedme.user.manager.select.error'));
        }

        return $result;
    }

    /**
     * @param $datas
     * @return array
     * @throws \Exception
     */
    private function populateUser($datas)
    {
        $fetchOne = false;
        if (!is_array($datas)) {
            $datas = [$datas];
            $fetchOne = true;
        }

        foreach ($datas as $user) {
            if ($user instanceof User) {
                $user->setGravatarImages([
                    80 => $this->gravatar->getUrl($user->getEmail()),
                    250 => $this->gravatar->getUrl($user->getEmail(), 250)
                ]);
            }
            // implement array format
        }

        if ($fetchOne && !isset($datas[0])) {
            throw new \Exception();
        }

        return $fetchOne ? $datas[0] : $datas;
    }
}