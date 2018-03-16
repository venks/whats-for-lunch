<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;

class LunchController extends FOSRestController
{
    /**
     *
     */
    public function getAction(Request $request)
    {
        $recipient = array();

        $response = array(
                    'code' => Response::HTTP_OK,
                    'data' => $recipient,
                    );

        $view = $this->view($response, Response::HTTP_OK);

        return $this->handleView($view);
    }

}
