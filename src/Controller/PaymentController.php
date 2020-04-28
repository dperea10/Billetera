<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ServicePayment;



class PaymentController extends AbstractController
{
    /**
     * @Route("/payment/soap/emite",name="emite")
     */
    public function emitPayment(Request $request, ServicePayment $servicePayment)
    {

        $soapServer = new \SoapServer('http://'.$_SERVER['HTTP_HOST'].'/Walletpt/public/wsdl/emitpayment.wsdl');
        $soapServer->setObject($servicePayment);
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml:text/xml; charset=UTF-8');

        ob_start();
        $soapServer->handle();

        $response->setContent(ob_get_clean());

        return $response;

    }
    /**
     * @Route("/payment/soap/confirm")
     */
    public function confirmPayment(Request $request, ServicePayment $servicePayment)
    {

        $soapServer = new \SoapServer('http://'.$_SERVER['HTTP_HOST'].'/Walletpt/public/wsdl/confirmpayment.wsdl');

        $soapServer->setObject($servicePayment);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml:text/xml; charset=UTF-8');

        ob_start();
        $soapServer->handle();

        $response->setContent(ob_get_clean());

        return $response;

    }
}
