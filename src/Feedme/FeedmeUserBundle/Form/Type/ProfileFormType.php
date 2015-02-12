<?php

namespace Feedme\FeedmeUserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as FOSUserProfileFormType;

/**
 * Class ProfileFormType
 * @package Feedme\FeedmeUserBundle\Form\Type
 */
class ProfileFormType extends FOSUserProfileFormType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstname', null, ['label' => 'form.firstname', 'required' => true])
            ->add('lastname', null, ['label' => 'form.lastname', 'required' => true])
            ->add('organization', null, ['label' => 'form.organization', 'required' => false])
            ->add('comment', 'textarea', ['label' => 'form.comment', 'required' => false, 'attr' => ['rows' => 4, 'cols' => 49]])
            ->add('location', null, ['label' => 'form.location', 'required' => false])
            ->add('website', 'url', ['label' => 'form.website', 'required' => false])
            ->add('backgroundImageUrl', 'url', ['label' => 'form.imageurl', 'required' => false])
        ;
    }

    public function getName()
    {
        return 'feedme_user_profile';
    }
}