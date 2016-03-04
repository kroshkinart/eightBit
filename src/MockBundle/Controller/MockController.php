<?php

namespace MockBundle\Controller;

use MockBundle\Entity\Data;
use MockBundle\Entity\ErrorResponse;
use MockBundle\Entity\LocationCollection;
use MockBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MockController extends Controller
{
    /**
     * @Route("/mock_service")
     */
    public function getLocationsAction()
    {
        $response = new JsonResponse();
        $response->setData($this->getRandomData());

        return $response;
    }

    public function getRandomData()
    {
        $location1 = new Location('Eiffel Tower', 21.12, 19.56);
        $location2 = new Location('The Pyramid of Cheops', 10.45, 48.89);
        $location3 = new Location('The Colossus of Rhodes', 35.09, 56.36);

        $locationCollection = new LocationCollection([$location1, $location2, $location3]);

        $successData = new Data($locationCollection, true);

        $errResponse = new ErrorResponse('string error message', 'string error code');
        $errorData = new Data($errResponse);

        $arr[] = $successData;
        $arr[] = $errorData;
        $arr[] = null;

        return $arr[array_rand($arr)];
    }
}
