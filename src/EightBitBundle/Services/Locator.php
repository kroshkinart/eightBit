<?php


namespace EightBitBundle\Services;

use EightBitBundle\Exception\CurlInitException;
use EightBitBundle\Exception\CurlErrorException;
use EightBitBundle\Exception\JsonMalformedException;
use EightBitBundle\Exception\ResponseErrorException;

class Locator
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

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

            $result['content'] = curl_exec($ch);
            $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $result['errno'] = curl_errno($ch);
            $result['errmsg'] = curl_error($ch);

            curl_close($ch);
        }

        return $result;
    }

    public function getLocations()
    {
        $response = $this->makeRequest();
        $content = json_decode($response['content']);

        if ($response === false) {
            throw new CurlInitException('Ошибка CURL при инициалзации запроса');
        } elseif ($response['errno'] != 0 || $response['status'] != 200) {
            throw new CurlErrorException('Ошибка CURL при выполнении запроса');
        } elseif (is_null($content)) {
            throw new JsonMalformedException('Неверный формат данных JSON');
        } elseif ($content->success === false) {
            throw new ResponseErrorException('JSON ответ с ошибкой. Сообщение: ' . $content->data->message . ', код: ' . $content->data->code);
        } elseif ($content->success === true) {
            return $content->data->locations;
        }
    }
}