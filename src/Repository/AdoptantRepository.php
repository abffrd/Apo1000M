<?php

namespace App\Repository;

use App\Entity\Adoptant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adoptant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adoptant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adoptant[]    findAll()
 * @method Adoptant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdoptantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adoptant::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Adoptant $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Adoptant $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Adoptant[] Returns an array of Adoptant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adoptant
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findOneByPhone(string $phone): ?Adoptant
    {
        dump('on est dans la fonction findOneByPhone ');
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Adoptant a
            WHERE a.telephone = :telephone'
             
        );
        $query->setParameter('telephone', $phone);

        // returns the adoptant or null if not found
        return $query->getOneOrNullResult();

    }
}
