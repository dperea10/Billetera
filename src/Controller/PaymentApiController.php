<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use nusoap_client;

class PaymentApiController extends FOSRestController {


    /**
     * @Rest\Post("/api/payment/payment")
     */
    public function emitPaymen( Request $request) {

        set_time_limit(0);
        ini_set("memory_limit", -1);

        $client = new nusoap_client('http://'.$_SERVER['HTTP_HOST'].'/index.php/payment/soap/payment?wsdl', 'wsdl');
        $client->setEndpoint('http://'.$_SERVER['HTTP_HOST'].'/index.php/payment/soap/payment');

        $client->decode_utf8 = true;

        $response = array( 'success'=>'',
            'cod_error' => '',
            'message_error' =>'',
            'data'=>[]);
        $data = json_decode($request->getContent('data'), true);
        $data = $data['data'];
        if ($data != null){
            
            $result = $client->call('emitpayment', array(
                'value' => $data['value'],
                'document' => $data['document'],
	            'email' => $data['email'],

            ));

            $response = json_decode($result);

        } else {
            $response['success'] = false;
            $response[ 'cod_error']=415;
            $response[ 'message_error']='Información no enviada!';
        }
        return new JsonResponse($response);
    }


    /**
     * @Rest\Post("/api/payment/confirm")
     */
    public function confirmPayment( Request $request) {

        set_time_limit(0);
        ini_set("memory_limit", -1);

        $client = new nusoap_client('http://'.$_SERVER['HTTP_HOST'].'/index.php/payment/soap/confirm?wsdl', 'wsdl');
        $client->setEndpoint('http://'.$_SERVER['HTTP_HOST'].'/index.php/payment/soap/confirm');

        $client->decode_utf8 = true;



        $response = array( 'success'=>'',
            'cod_error' => '',
            'message_error' =>'',
            'data'=>[]);
        $data = json_decode($request->getContent('data'), true);
        $data = $data['data'];
        if ($data != null){
            
            $result = $client->call('confirmpayment', array(
                'token' => $data['token'],
                'document' => $data['document']

            ));

            $response = json_decode($result);

        } else {
            $response['success'] = false;
            $response[ 'cod_error']=415;
            $response[ 'message_error']='Información no enviada!';
        }
        return new JsonResponse($response);
    }

}
