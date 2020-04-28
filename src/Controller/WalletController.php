<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ServiceWallet;




class WalletController extends AbstractController
{
     /**
     * @Route("/wallet/soap/recharge",name="rechargeWallet")
     */
    public function regWallet(Request $request, ServiceWallet $serviceWallet)
    {

        $soapServer = new \SoapServer('http://'.$_SERVER['HTTP_HOST'].'/Walletpt/public/wsdl/wallet.wsdl');

        $soapServer->setObject($serviceWallet);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();

        $response->setContent(ob_get_clean());

        return $response;

    }
    /**
     * @Route("/wallet/soap/consult",name="consultWallet")
     */
    public function conWallet(Request $request, ServiceWallet $serviceWallet)
    {

        $soapServer = new \SoapServer('http://'.$_SERVER['HTTP_HOST'].'/Walletpt/public/wsdl/conwallet.wsdl');

        $soapServer->setObject($serviceWallet);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml:text/xml; charset=UTF-8');

        ob_start();
        $soapServer->handle();

        $response->setContent(ob_get_clean());

        return $response;

    }

}
