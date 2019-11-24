<?php

namespace App\Repository;

use App\Entity\Participants;
use App\Entity\Trips;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Validator\Constraints\Date;

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

    /**
      * @return Trips[] Returns an array of Trips objects
     *
     */

    public function findByFilters($idSite = null, $search = null, $debut = null, $fin = null, $orgaTrip = null)
    {
        $queryBuilder = $this->createQueryBuilder('a');

        if ($idSite !== null){
            $queryBuilder->innerJoin(Participants::class,'p',Join::WITH,'p.id = a.organizer');
            $queryBuilder->andWhere('p.site = :site');
            $queryBuilder->setParameter('site', $idSite);
        }
        if ($search !== null){
            $queryBuilder ->andWhere('a.name LIKE :search');
            $queryBuilder->setParameter('search', '%' .$search. '%');
        }
        if ($debut !== null or $fin !== null){
            $queryBuilder->andWhere('a.date_start >= :debut');
            $queryBuilder->andWhere('a.date_closing <= :fin');
            $queryBuilder->setParameter('debut', $debut);
            $queryBuilder->setParameter('fin', $fin);
        }
        if ($orgaTrip !== null){
            $queryBuilder->andWhere('a.organizer = :orgaTrip');
            $queryBuilder->setParameter('orgaTrip', $orgaTrip);
        }
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }


     public function findByCity($idSite)
 {
        //récupère le
        return $this->createQueryBuilder('t')
            ->innerJoin(Participants::class,'p',Join::WITH,'p.id = t.organizer')
            //->innerJoin(Registrations::class,'r',Join::WITH, 'r.participant = p.id')
            ->andWhere('p.site = :id')
            ->setParameter('id', $idSite)
            //->innerJoin(CitiesRepository::class,'c',Join::ON, 'c.id = ')
            //->setParameter('val', $value)
            //->innerJoin('AppBundle:GroupUser', 'gu', Join::ON, 'g.id = gu.group_id')
            //->andWhere('t.exampleField = :val')
            //->setParameter('val', $value)
            //->orderBy('t.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            //->getOneOrNullResult();
        ;
    }

    public function findByName($search = null)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.name LIKE :search')
            ->setParameter('search', '%' .$search. '%')
            ->getQuery()
            ->getResult();
    }

    public function findByDate($debut , $fin)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.date_start >= :debut')
            ->andWhere('d.date_closing <= :fin')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->getQuery()
            ->getResult();
    }

    public function findByOrga($idOrga)
    {
        return$this->createQueryBuilder('o')
            ->andWhere('o.organizer = :orga')
            ->setParameter('orga', $idOrga)
            ->getQuery()
            ->getResult();
    }

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
