<?php


namespace MockBundle\Entity;

/**
 * Class Data
 * @author Kroshkin Artem <kroshkinphp@gmail.com>
 * @package MockBundle\Entity
 *
 * Данные ответа
 */
class Data
{
    /**
     * Данные
     */
    public $data;

    /**
     * @var bool
     *
     * Статус
     */
    public $success;

    public function __construct($data, $success = false)
    {
        $this->data = $data;
        $this->success = $success;
    }
}