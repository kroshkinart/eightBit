<?php


namespace MockBundle\Entity;


/**
 * Class LocationCollection
 * @author Kroshkin Artem <kroshkinphp@gmail.com>
 * @package MockBundle\Entity
 *
 * Коллекция объектов Location
 */
class LocationCollection
{
    /**
     * @var array
     *
     * Массив объектов расположений
     */
    public $locations;

    public function __construct(Array $locations)
    {
        $this->locations = $locations;
    }
}