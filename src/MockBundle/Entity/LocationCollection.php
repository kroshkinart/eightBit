<?php


namespace MockBundle\Entity;


class LocationCollection
{
    public $locations;

    public function __construct(Array $locations)
    {
        $this->locations = $locations;
    }
}