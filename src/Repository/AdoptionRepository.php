<?php

namespace App\Repository;

use App\Entity\Adoption;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adoption|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adoption|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adoption[]    findAll()
 * @method Adoption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdoptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adoption::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Adoption $entity, bool $flush = true): void
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
    public function remove(Adoption $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findAPrendre($statut)
    {
       $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Adoption a
            WHERE a.statut like :statut'
             
        )->setParameter('statut', $statut);


        return $query->getResult();

    }

    public function findMine($id)
    {
       $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a 
            FROM App\Entity\Adoption a
            JOIN a.users u
            
            WHERE u.id = :id'
             
        )->setParameter('id', $id);


        return $query->getResult();

    }   

    public function findByAdoptant($adoptant)
    {
       $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a 
            FROM App\Entity\Adoption a
            JOIN a.adoptant u
            
            WHERE u.id = :id'
             
        )->setParameter('id', $adoptant);


        return $query->getResult();

    }   

    
    // /**
    //  * @return Adoption[] Returns an array of Adoption objects
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
    public function findOneBySomeField($value): ?Adoption
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
