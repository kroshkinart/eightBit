<?php


namespace MockBundle\Entity;


class ErrorResponse
{
    public $message;
    public $code;

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }
}