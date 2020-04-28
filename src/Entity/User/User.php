<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer", unique=true)
     */
    private $id;

     /**
     * @ORM\Column(name="document", type="string", nullable=true)
     */
    private $document;

    /**
     * @ORM\Column(name="names", type="string", nullable=false)
     */
    private $names;


    /**
     * @ORM\Column(name="movil", type="string", nullable=false)
     */
    private $movil;



    /**
     * @ORM\Column(name="email",type="string", nullable=false, length=80)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Wallet\Wallet", mappedBy="userPayment_Ur")
     */
    private $wallet_Ur;



    public function getId(): ?int
    {
        return $this->id;
    }

     /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param mixed $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param mixed $names
     */
    public function setNames($names)
    {
        $this->names = $names;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * @param mixed $movil
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
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
    public function setWallet_Ur($wallet_Ur)
    {
        $this->wallet_Ur = $wallet_Ur;
        return $this;
    }

}
