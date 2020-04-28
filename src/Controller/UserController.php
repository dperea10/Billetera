<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ServiceUser;



class UserController extends AbstractController
{
    /**
     * @Route("/user/soap")
     */
    public function createUser(Request $request, ServiceUser $serviceUser)
    {

        $soapServer = new \SoapServer('http://'.$_SERVER['HTTP_HOST'].'/Walletpt/public/wsdl/user.wsdl');

        $soapServer->setObject($serviceUser);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();

        $response->setContent(ob_get_clean());

        return $response;

    }
}
