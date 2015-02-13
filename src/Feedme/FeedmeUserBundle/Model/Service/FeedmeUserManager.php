<?php

namespace Feedme\FeedmeUserBundle\Model\Service;

use Feedme\FeedmeUserBundle\Model\Message\Result;
use Feedme\FeedmeUserBundle\Model\Service\Filter\User as UserFilter;
use FOS\UserBundle\Doctrine\UserManager;
use Feedme\FeedmeUserBundle\Model\Entity\User;
use Ornicar\GravatarBundle\GravatarApi;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class UserManager
 * @package Feedme\FeedmeUserBundle\Service
 */
class FeedmeUserManager
{
    /**
     * @var UserManager
     */
    protected $userEntity;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var GravatarApi
     */
    protected $gravatar;

    /**
     * @param UserManager $manager
     * @param TranslatorInterface $translator
     * @param GravatarApi $gravatar
     */
    public function __construct(UserManager $manager, TranslatorInterface $translator, GravatarApi $gravatar)
    {
        $this->userEntity = $manager;
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
            $user = $this->userEntity->findUserBy($params);
            if (is_null($user)) {
                throw new \Exception();
            }
            $user->setGravatarImages([
                80 => $this->gravatar->getUrl($user->getEmail()),
                250 => $this->gravatar->getUrl($user->getEmail(), 250)
            ]);
            $result->setMessage($user);
            $result->setSuccess(true);
        } catch (\Exception $e) {
            $result->setError($this->translator->trans('feedme.user.manager.select.error'));
        }

        return $result;
    }
}