<?php

namespace Feedme\FeedmeUserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use \FOS\UserBundle\Form\Type\RegistrationFormType as FOSUserRegistrationFormType;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class RegistrationFormType
 * @package Feedme\FeedmeUserBundle\Form\Type
 */
class RegistrationFormType extends FOSUserRegistrationFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('firstname', null,['constraints' => $this->getValidators('firstname'), 'translation_domain' => 'messages'])
            ->add('lastname', null, ['constraints' => $this->getValidators('lastname'), 'translation_domain' => 'messages'])
        ;
    }

    public function getName()
    {
        return 'feedme_user_registration';
    }

    private function getValidators($name)
    {
        $validators = [];
        $validator = new NotBlank(['groups' => ['Registration', 'Profile']]);
        $validator->message = sprintf('form.validation.%s.notblank', $name);
        $validators[] = $validator;

        return $validators;
    }
}
