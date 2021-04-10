<?php

namespace App\Repository;

use App\Entity\Biblioteca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\From;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Biblioteca|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biblioteca|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biblioteca[]    findAll()
 * @method Biblioteca[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BibliotecaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biblioteca::class);
    }


    /*
    public function findAllGreaterThanPrice(string $titulo): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Biblioteca p
            WHERE p.titulo > :titulo'
        )->setParameter('titulo', $titulo);

        // returns an array of Product objects
        return $query->getResult();
    }
*/
    /**
     * @return Biblioteca[] 
     */
    /*
    public function findAllGreaterThanPrice( string $autor): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->where('p.autor > :autor')
            ->setParameter('autor', $autor)
            ->orderBy('p.autor', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();

        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();
    }
    */
    
    public function findAllGreaterThanPrice(string $titulo): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')

            
            ->andWhere('p.titulo LIKE :titulo OR p.autor LIKE :titulo OR p.descripcion LIKE :titulo')
            ->setParameter('titulo','%' .$titulo.'%');
            
            $query = $qb->getQuery();

        return $query->execute();
    }







    // /**
    //  * @return Biblioteca[] Returns an array of Biblioteca objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Biblioteca
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
