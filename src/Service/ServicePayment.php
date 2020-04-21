<?php

namespace App\Service;


use App\Entity\User\User;
use App\Entity\Payment\Payment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;




class ServicePayment
{
    public function __construct(EntityManagerInterface $entityManager,\Swift_Mailer $mailer)
    {
        $this->em = $entityManager;
        $this->mailer = $mailer;
    }

    public function emitPayment($document,$email, $value ){
        /**
         * @var User $serUser
         */


        $response = array('success' => false,
            'cod_error' => '',
            'message_error' => '');
        if($document != null && $value != null && $email != null){

            try{

                $validateDocument =$this->em->getRepository('App:User\User')->validateUserDocument($document);

                if($validateDocument ){

                    $serUser  = $this->em->getRepository('App:User\User')->findBy(array('document'=>$document));

                    $serWallet  = $this->em->getRepository("App:Wallet\Wallet")->findBy(array('user_id'=>$serUser[0]->getId()));

                    $serPayment = new Payment();
                    $token = $this->generarToken();
                    $serPayment->setWalletRel($serWallet[0]);
                    $serPayment->setValue($value);
                    $serPayment->setConfirm(false);
                    $serPayment->setToken($token);
                    $this->em->persist($serPayment);
                    $this->em->flush();

                    $response['success'] = true;
                    $response['data'] = 'En hora hora, para continuar ingrese a su correo para validar con el token generado!';

                    $this->sendemail($email, $token);

                }else{
                    $response['success'] = false;
                    $response['cod_error'] = 416;
                    $response['message_error'] = 'No se encontró su identificación';
                }
            } catch (Exception $e){
                $response['success'] = false;
                $response['cod_error'] = $e->getCode();
                $response['message_error'] = $e->getMessage();
            }
        } else{
            $response['success'] = false;
            $response['message_error'] = 'Información no enviada!';
            $response['cod_error'] = 415;
        }

        return json_encode($response);
    }

    public function confirmPayment($document, $token){

        $response = array('success' => false,
            'cod_error' => '',
            'message_error' => '');
        if($document != null && $token != null){
            try{
                $validateDocument =$this->em->getRepository('App:User\User')->validateUserDocument($document);
                if($validateDocument){
                    $serUser  = $this->em->getRepository('App:User\User')->findBy(array('document'=>$document));

                    $serWallet  = $this->em->getRepository("App:Wallet\Wallet")->findBy(array('user_id'=>$serUser[0]->getId()));

                    $serPayment =  $this->em->getRepository("App:Payment\Payment")->findBy(array('token'=>$token));


                    if($serPayment){
                        if( $serPayment[0]->getToken() == $token){
                            $valuePayment = $serPayment[0]->getValue();
                            if(($serWallet[0]->getBalance() - $valuePayment ) < 0){
                                $response['success'] = false;
                                $response['cod_error'] = 417;
                                $response['message_error'] = 'Disculpe, no posee el fondo suficiente!';
                            } else {
                                if(!$serPayment[0]->getConfirm()){
                                    $serPayment[0]->setConfirm(true);
                                    $valuePayment = $serPayment[0]->getValue();
                                    $balance_Tod = $serWallet[0]->getBalance();
                                    $balance_Tod -= $valuePayment;
                                    $serWallet[0]->getBalance($balance_Tod);
                                    $this->em->persist($serWallet[0]);
                                    $this->em->flush();
                                    $response['success'] = true;
                                    $response['cod_error'] = '';
                                    $response['message_error'] = 'En hora buena, ha realizado el pago con éxito';
                                } else {
                                    $response['success'] = false;
                                    $response['cod_error'] = 417;
                                    $response['message_error'] = 'En hora buena, se ha confirmado el pago';
                                }

                            }

                        }else{
                            $response['success'] = false;
                            $response['cod_error'] = 417;
                            $response['message_error'] = 'Disculpe, el token no coincide transacción negada';
                        }
                    } else{
                        $response['success'] = false;
                        $response['cod_error'] = 417;
                        $response['message_error'] = 'Disculpe, el token no coincide transacción negada';
                    }

                }else{
                    $response['success'] = false;
                    $response['cod_error'] = 417;
                    $response['message_error'] = 'Disculpe, transacción rechazada';
                }
            } catch (Exception $e){
            $response['success'] = false;
            $response['cod_error'] = $e->getCode();
            $response['message_error'] = $e->getMessage();
            }
        }
        return json_encode($response);
   }

    private function generarToken(){

        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits = '1234567890';
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $letters[rand(0, strlen($letters) - 1)];
        }
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $digits[rand(0, strlen($digits) - 1)];
        }

        return $randomString;
    }

    private function sendemail($email, $token){
            $message = ( new \Swift_Message( 'ingrese el token para confirmar' ) )
            ->setFrom( 'diego.perea.dp@gmail.com' )
            ->setTo( $email )
            ->setBody(
                $token,
                'text/html'
            );
        $this->mailer->send( $message );
    }
}