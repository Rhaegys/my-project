<?php

namespace App\Repository;

use App\Entity\Instrument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Instrument|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instrument|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instrument[]    findAll()
 * @method Instrument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstrumentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Instrument::class);
    }

    public function findByOwner($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.owner = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findOneBySymbol($value): ?Instrument
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.symbol = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findByOwnerAndSymbol($owner,$symbol): ?Instrument
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.owner = :val')
            ->setParameter('val', $owner)
            ->andWhere('i.symbol = :val1')
            ->setParameter('val1', $symbol)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
