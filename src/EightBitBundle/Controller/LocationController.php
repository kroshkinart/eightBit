<?php

namespace EightBitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EightBitBundle\Exception\CurlInitException;
use EightBitBundle\Exception\CurlErrorException;
use EightBitBundle\Exception\JsonMalformedException;
use EightBitBundle\Exception\ResponseErrorException;

class LocationController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('EightBitBundle:Location:index.html.twig');
    }

    /**
     * @Route("/locations", name="_locations")
     */
    public function locationAction()
    {
        $locator = $this->get('locator');
        $res = $msg = false;

        try {
            $res = $locator->getLocations();
        } catch (CurlInitException $e) {
            $msg = $e->getMessage();
        } catch (CurlErrorException $e) {
            $msg = $e->getMessage();
        } catch (JsonMalformedException $e) {
            $msg = $e->getMessage();
        } catch (ResponseErrorException $e) {
            $msg = $e->getMessage();
        } catch (\Exception $e) {
            $msg = 'Неизвестная ошибка:' . $e->getMessage();
        }

        return $this->render('EightBitBundle:Location:locations.html.twig', array(
            'locations' => $res,
            'msg' => $msg,
        ));
    }
}
