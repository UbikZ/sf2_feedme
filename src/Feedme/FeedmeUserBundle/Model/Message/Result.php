<?php

namespace Feedme\FeedmeUserBundle\Model\Message;

/**
 * Class Result
 * @package Feedme\FeedmeUserBundle\Model\Message
 */
class Result
{
    /** @var bool  */
    private $success = false;
    /** @var  mixed */
    private $message;
    /** @var array  */
    private $errors = [];


    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
    /**
     * @param array $error
     */
    public function setError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }
}