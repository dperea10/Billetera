<?php

namespace App\Service;


use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;



class ServiceWallet
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function regWallet($document, $movil, $value) {
        /**
         * @var User $serUser
         */

        $response = array('success' => false,
            'cod_error' => '',
            'message_error' => '');
        if($document != null && $movil != null && $value!= null){
            try{

                $validateDocument =$this->em->getRepository('App:User\User')->validateUserDocument($document);
                $validateMovil =$this->em->getRepository('App:User\User')->validateUserMovil($movil);
                if($validateDocument && $validateMovil){

                    $serUser  = $this->em->getRepository('App:User\User')->findOneBy(array('document'=>$document));

                    $serWallet  = $this->em->getRepository("App:Wallet\Wallet")->findOneBy(array('user_id'=>$serUser->getId()));
                    $balance_Tod = $serWallet->getBalance();
                    $balance_End = (integer)$balance_Tod + (integer)$value;
                    $serWallet->setBalance($balance_End);
                    $this->em->persist($serWallet);
                    $this->em->flush();
                    $response['success'] = true;
                    $response['data'] = 'En hora buena, disfrute de su nuevo saldo'. $serWallet->getBalance();


                }
            } catch (Exception $e){
                $response['success'] = false;
                $response['cod_error'] = $e->getCode();
                $response['message_error'] = $e->getMessage();
            }
        } else{
            $response['success'] = false;
            $response['message_error'] = 'Información no enviada';
            $response['cod_error'] = 415;
        }

        return json_encode($response);
    }

    public function conWallet($document, $movil){
        $response = array('success' => false,
            'cod_error' => '',
            'message_error' => '');
        if($document != null && $movil != null){
            try{
                $validateDocument =$this->em->getRepository('App:User\User')->validateUserDocument($document);
                $validateMovil =$this->em->getRepository('App:User\User')->validateUserMovil($movil);
                if($validateDocument && $validateMovil){
                    $serUser =   $serUser  = $this->em->getRepository('App:User\User')->findOneBy(array('document'=>$document));
                    $balance = $serUser->getWalletRel()->getBalance();
                    $response['success'] = true;
                    $response['cod_error'] = '';
                    $response['message_error'] = '';
                    $response['data'] = $balance;
                } else{
                    $response['success'] = false;
                    $response['cod_error'] = 416;
                    $response['message_error'] = 'Datos invalidos';
                }
            }catch (Exception $e){
                $response['success'] = false;
                $response['cod_error'] = $e->getCode();
                $response['message_error'] = $e->getMessage();
            }
        } else{
            $response['success'] = false;
            $response['message_error'] = 'Información no enviada';
            $response['cod_error'] = 415;
        }

        return json_encode($response);

    }


}