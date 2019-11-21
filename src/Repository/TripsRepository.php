<?php

namespace App\Repository;

use App\Entity\Participants;
use App\Entity\Places;
use App\Entity\Trips;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Trips|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trips|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trips[]    findAll()
 * @method Trips[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trips::class);
    }

   // /**
     // * @return Trips[] Returns an array of Trips objects
    // */
    // public function findByCity($idCity)
// {
        //récupère
   //     return $this->createQueryBuilder('t')
            //->innerJoin(Participants::class,'p',Join::WITH,'t.organizer = p.id')
            //->andWhere('p.site = :id')
            //->setParameter('id', $idCity)
            //->innerJoin(CitiesRepository::class,'c',Join::ON, 'c.id = ')
            //->setParameter('val', $value)
            //->innerJoin('AppBundle:GroupUser', 'gu', Join::ON, 'g.id = gu.group_id')
            //->andWhere('t.exampleField = :val')
            //->setParameter('val', $value)
            //->orderBy('t.id', 'ASC')
            //->setMaxResults(10)
     //       ->getQuery()
       //     ->getResult()
       // ;
   // }


    /*
    public function findOneBySomeField($value): ?Trips
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
