<?php


namespace EightBitBundle\Services;

use EightBitBundle\Exception\CurlInitException;
use EightBitBundle\Exception\CurlErrorException;
use EightBitBundle\Exception\JsonMalformedException;
use EightBitBundle\Exception\ResponseErrorException;

/**
 * Class Locator
 * @author Kroshkin Artem <kroshkinphp@gmail.com>
 * @package EightBitBundle\Services
 *
 * Сервис для работы с расположениями объектов
 */
class Locator
{
    /**
     * Адрес внешнего сервиса
     */
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool|mixed
     *
     * CURL запрос на получение
     */
    public function makeRequest()
    {
        $result = false;

        if ($ch = curl_init()) {
            $options = array(
                CURLOPT_URL            => $this->url,
                CURLOPT_RETURNTRANSFER => true,
            );
            curl_setopt_array($ch, $options);

            $result = curl_getinfo($ch);

            $result['content'] = curl_exec($ch); // json ответ сервиса
            $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE); // статус http ответа
            $result['errno'] = curl_errno($ch); // номер ошибки
            $result['errmsg'] = curl_error($ch); // сообщение ошибки

            curl_close($ch);
        }

        return $result;
    }

    /**
     * @return mixed
     * @throws CurlErrorException
     * @throws CurlInitException
     * @throws JsonMalformedException
     * @throws ResponseErrorException
     *
     * Получение данных с внешнего сервиса и генерация соотвествующих исключений
     */
    public function getLocations()
    {
        $response = $this->makeRequest();
        $content = json_decode($response['content']); // объект данных Data

        // Проверки всех возможных ошибок
        if ($response === false) {
            throw new CurlInitException('Ошибка CURL при инициалзации запроса');
        } elseif ($response['errno'] != 0 || $response['status'] != 200) {
            throw new CurlErrorException('Ошибка CURL при выполнении запроса');
        } elseif (is_null($content)) {
            throw new JsonMalformedException('Неверный формат данных JSON');
        } elseif ($content->success === false) {
            throw new ResponseErrorException('JSON ответ с ошибкой. Сообщение: ' . $content->data->message . ', код: ' . $content->data->code);
        } elseif ($content->success === true) {
            return $content->data->locations; // возвращаем массив объектов location в случае успеха
        }
    }
}