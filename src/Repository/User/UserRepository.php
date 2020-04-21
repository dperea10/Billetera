<?php

namespace App\Repository\User;

use App\Entity\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function validateUserEmail($email){
        $em = $this->getEntityManager();

        $user = $em->getRepository('App:User\User')->findBy(array('email'=>$email));
        if ($user){
            return true;
        }
        else {
            return false;
        }
    }

    public function validateUserDocument($document){
        $em = $this->getEntityManager();

        $user = $em->getRepository('App:User\User')->findBy(array('document'=>$document));
        if ($user){
            return true;
        }
        else {
            return false;
        }
    }

    public function validateUserMovil($movil){
        $em = $this->getEntityManager();

        $user = $em->getRepository('App:User\User')->findBy(array('movil'=>$movil));
        if ($user){
            return true;
        }
        else {
            return false;
        }
    }

    public function serUserDocument($id){
        $em = $this->getEntityManager();
        $serUser = $em->getRepository('App:User\User')->findBy(array('document'=>$id));
        if($serUser){
            return $serUser;
        } else {
            return false;
        }
    }


    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
