<?php

namespace App\Repository;

use App\Entity\Participants;
use App\Entity\Registrations;
use App\Entity\Status;
use App\Entity\Trips;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Security\Core\Security;
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

    public function findByFilters(Participants $user, $idSite, $search, $debut, $fin, $orgaTrip, $regiTrip, $noreTrip )
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
            $queryBuilder->setParameter('orgaTrip', $user->getId());
        }
        if ($regiTrip !== null){
            $queryBuilder->innerJoin(Registrations::class,'r',Join::WITH,'r.trips = a.id');
            $queryBuilder->innerJoin(Participants::class, 'z', Join::WITH, 'z.id = r.participant');
            $queryBuilder->andWhere('r.participant = :regiTrip');
            $queryBuilder->setParameter('regiTrip', $user->getId());
        }
        if ($noreTrip !== null){
            $queryBuilder->innerJoin(Registrations::class,'r',Join::WITH,'r.trips = a.id');
            $queryBuilder->innerJoin(Participants::class, 'z', Join::WITH, 'z.id = r.participant');
            $queryBuilder->andWhere('z.id = :noreTrip');
            $queryBuilder->setParameter('noreTrip', !$user->getId());
        }
        /*if ($oldsTrip !== null){
            $queryBuilder->innerJoin(StatusRepository::class,'s',Join::WITH,'s.id = a.status');
            $queryBuilder->andWhere('s.id = :oldsTrip');
            $queryBuilder->setParameter('oldsTrip', $status->getLabel('Passée'));
        }*/


        $query = $queryBuilder->getQuery();
        return $query->getResult();
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
