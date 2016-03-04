<?php


namespace MockBundle\Entity;


/**
 * Class Location
 * @author Kroshkin Artem <kroshkinphp@gmail.com>
 * @package MockBundle\Entity
 *
 * Расположение объекта
 */
class Location
{
    /**
     * @var
     *
     * Название объекта
     */
    public $name;

    /**
     * @var
     *
     * Координаты объекта
     */
    public $coordinates;

    public function __construct($name, $lat, $long)
    {
        $this->name = $name;
        $this->coordinates['lat'] = $lat;
        $this->coordinates['long'] = $long;
    }
}