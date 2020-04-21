<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use nusoap_client;

class WalletApiController extends FOSRestController {


    /**
     * @Rest\Post("/api/wallet/recharge")
     */
    public function regWallet( Request $request) {

        set_time_limit(0);
        ini_set("memory_limit", -1);

        $client = new nusoap_client('http://'.$_SERVER['HTTP_HOST'].'/index.php/wallet/soap/recharge?wsdl', 'wsdl');
        $client->setEndpoint('http://'.$_SERVER['HTTP_HOST'].'/index.php/wallet/soap/recharge');

        $client->decode_utf8 = true;



        $response = array( 'success'=>'',
            'cod_error' => '',
            'message_error' =>'',
            'data'=>[]);
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent('data'), true);
        $data = $data['data'];
        if ($data != null){
            // Calls
            $result = $client->call('regwallet', array(
                'document' => $data['document'],
                'movil'=> $data['movil'],
                'value'=> $data['value']

            ));

            $response = json_decode($result);

        } else {
            $response['success'] = false;
            $response[ 'cod_error']=415;
            $response[ 'message_error']='Informacion no enviada!';
        }
        return new JsonResponse($response);
    }

    /**
     * @Rest\Post("/api/wallet/consult")
     */
    public function conWallet( Request $request) {

        set_time_limit(0);
        ini_set("memory_limit", -1);


        $client = new nusoap_client('http://'.$_SERVER['HTTP_HOST'].'/index.php/wallet/soap/consult?wsdl', 'wsdl');
        $client->setEndpoint('http://'.$_SERVER['HTTP_HOST'].'/index.php/wallet/soap/consult');

        $client->decode_utf8 = true;



        $response = array( 'success'=>'',
            'cod_error' => '',
            'message_error' =>'',
            'data'=>[]);
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent('data'), true);
        $data = $data['data'];
        if ($data != null){
            // Calls
            $result = $client->call('conwallet', array(
                'document' => $data['document'],
                'movil'=> $data['movil']
            ));

            $response = json_decode($result);

        } else {
            $response['success'] = false;
            $response[ 'cod_error']=415;
            $response[ 'message_error']='Informacion no enviada';
        }
        return new JsonResponse($response);
    }



}
