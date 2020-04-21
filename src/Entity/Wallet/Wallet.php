<?php

namespace App\Entity\Wallet;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Wallet\WalletRepository")
 */
class Wallet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(name="balance", type="integer", nullable=false)
     */
    private $balance=0;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $user_id;

     /**
     * @ORM\OneToOne(targetEntity="App\Entity\User\User", inversedBy="wallet_Ur")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userPayment_Ur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Payment\Payment", mappedBy="wallet_Ur")
     */
    private $payment_Ur;

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
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getUser_Id()
    {
        return $this->user_Id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUser_Id($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserPayment_Ur()
    {
        return $this->userPayment_Ur;
    }

    /**
     * @param mixed $userPayment_Ur
     */
    public function setUserPayment_Ur($userPayment_Ur): void
    {
        $this->userPayment_Ur = $userPayment_Ur;
    }

    /**
     * @return mixed
     */
    public function getPayment_Ur()
    {
        return $this->payment_Ur;
    }

    /**
     * @param mixed $payment_Ur
     */
    public function setPayment_Ur($payment_Ur): void
    {
        $this->payment_Ur = $payment_Ur;
    }

}
