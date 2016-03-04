<?php


namespace MockBundle\Entity;


class Location
{
    public $name;
    public $coordinates;

    public function __construct($name, $lat, $long)
    {
        $this->name = $name;
        $this->coordinates['lat'] = $lat;
        $this->coordinates['long'] = $long;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }
}