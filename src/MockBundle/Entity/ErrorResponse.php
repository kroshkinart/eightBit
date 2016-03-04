<?php


namespace MockBundle\Entity;


/**
 * Class ErrorResponse
 * @author Kroshkin Artem <kroshkinphp@gmail.com>
 * @package MockBundle\Entity
 *
 * JSON ответ с ошибкой
 */
class ErrorResponse
{
    /**
     * @var
     *
     * Сообщение ошибки
     */
    public $message;

    /**
     * @var
     *
     * Код ошибки
     */
    public $code;

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }
}