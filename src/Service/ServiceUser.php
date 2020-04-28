<?php

namespace App\Service;

use App\Entity\User\User;
use App\Entity\Wallet\Wallet;
use Doctrine\ORM\EntityManagerInterface;


class ServiceUser
{


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function createUser($document, $names, $movil, $email )
    {


        $response = array('success' => false,
            'cod_error' => '',
            'message_error' => '');
            if ($names != null){
                try{
                    $serUser = new User();
                    $serWallet = new Wallet();

                    if($this->em->getRepository('App:User\User')->validateUserEmail($email) || $this->em->getRepository('App:User\User')->validateUserDocument($document) ){
                        $response['success'] = false;
                        $response['cod_error'] = 416;
                        $response['message_error'] = 'Vefique el correo o el telefono, los ingresados ya existen';
                    } else {
                       
                        $serUser->setDocument($document);
                        $serUser->setNames($names);
                        $serUser->setMovil($movil);
                        $serUser->setEmail($email);
                        $this->em->persist($serUser);
                        $serWallet->setUserPayment_Ur($serUser);
                        $serWallet->setBalance(0);
                        $this->em->persist($serWallet);
                        $this->em->flush();
                        $response['success'] = true;
                        $response['data'] = 'En hora buena, Registro creado existosamente';

                    }

                }
                catch (\Exception $e){
                    $response['success'] = false;
                    $response['cod_error'] = $e->getCode();
                    $response['message_error'] = $e->getMessage();
                }

            } else{
                $response['success'] = false;
                $response['message_error'] = 'información no enviada';
                $response['cod_error'] = 415;
             }

            return json_encode($response);

    }
}