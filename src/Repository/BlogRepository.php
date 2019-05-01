<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Blog::class);
    }
    
    public function findBlogsNmb($nmb)
    {
    	$qb = $this->createQueryBuilder('b');
    	$qb -> orderBy('b.id', 'ASC');
    	
    	if($nmb != '*'){
    		$qb -> setMaxResults($nmb);
	    }
    	
        return $qb ->getQuery()
	               ->getResult()
        ;
    }

    // /**
    //  * @return Blog[] Returns an array of Blog objects
    //  */
    /*
    */

    /*
    public function findOneBySomeField($value): ?Blog
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
