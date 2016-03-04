<?php


namespace MockBundle\Entity;

class Data
{
    public $data;
    public $success;

    public function __construct($data, $success = false)
    {
        $this->data = $data;
        $this->success = $success;
    }
}