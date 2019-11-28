<?php

namespace App\Repository;

use App\Entity\Participants;
use App\Entity\Registrations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Registrations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registrations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registrations[]    findAll()
 * @method Registrations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistrationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registrations::class);
    }

    public function findByIdTrip($idTrip)
    {

        return $this->createQueryBuilder('r')
            ->innerJoin(Participants::class, 'p',Join::WITH, 'p.id = r.participant' )
            ->Where('r.trips = :id')
            ->setParameter('id', $idTrip)
            ->getQuery()
            ->getResult()
        ;
    }



    // exemple de requête : SELECT * FROM registrations where participant_id = 2 and trips_id = 9
    public function findOneByPartIdAndTripsId($idPart, $idTrips): ?Registrations
    {
        try {
            return $this->createQueryBuilder('r')
                ->andWhere('r.participant = :idPart AND r.trips = :idTrips')
                ->setParameter('idPart', $idPart)
                ->setParameter('idTrips', $idTrips)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }

    }


    /*
    public function findOneBySomeField($value): ?Registrations
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
