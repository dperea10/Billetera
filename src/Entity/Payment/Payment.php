<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Payment\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id",type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(name="token", type="text", nullable=false)
     */
    private $token;

    /**
     * @ORM\Column(name="wallet_id", type="integer", nullable=false)
     */
    private $wallet_id;

    /**
     * @ORM\Column(name="value", type="integer", nullable=false)
     */
    private $value;

    /**
     * @ORM\Column(name="confirm_Trans", type="boolean", nullable=false)
     */
    private $confirm_Trans = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Wallet\Wallet", inversedBy="Payment_Ur")
     * @ORM\JoinColumn(name="wallet_id", referencedColumnName="id")
     */
    private $wallet_Ur;

    /**
     * @return mixed
     */

    public function getId(): ?int
    {
        return $this->id;
    }
     /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getWallet_Id()
    {
        return $this->wallet_Id;
    }

    /**
     * @param mixed $wallet_Id
     */
    public function setWalllet_Id($wallet_Id): void
    {
        $this->wallet_Id = $wallet_Id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getConfirm_Trans()
    {
        return $this->confirm_Trans;
    }

    /**
     * @param mixed $confirm_Trans
     */
    public function setConfirm_Trans($confirm_Trans): void
    {
        $this->confirm_Trans = $confirm_Trans;
    }

    /**
     * @return mixed
     */
    public function getWallet_Ur()
    {
        return $this->wallet_Ur;
    }

    /**
     * @param mixed $wallet_Ur
     */
    public function setWallet_Ur($wallet_Ur): void
    {
        $this->wallet_Ur = $wallet_Ur;
    }



}
