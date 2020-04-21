<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use nusoap_client;



class UserApiController extends FOSRestController {


    /**
     * @Rest\Post("/api/user/create")
     */
    public function createUser( Request $request) {

        set_time_limit(0);
        ini_set("memory_limit", -1);

        $client = new nusoap_client('http://'.$_SERVER['HTTP_HOST'].'/index.php/user/soap?wsdl', 'wsdl');
        $client->setEndpoint('http://'.$_SERVER['HTTP_HOST'].'/index.php/user/soap');

        $client->decode_utf8 = true;



        $response = array( 'success'=>'',
            'cod_error' => '',
            'message_error' =>'',
            'data'=>[]);
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent('data'), true);
        $data = $data['data'];
        if ($data != null){
           
            $result = $client->call('createuser', array(
                'names'=>  $data['names'],
                'movil'=> $data['movil'],
                'email' => $data['email'],
                'document' => $data['document']
            ));

            $response = json_decode($result);

        } else {
            $response['success'] = false;
            $response['cod_error']=415;
            $response['message_error']='Información no enviada!';
        }

        return new JsonResponse($response);
    }

}
